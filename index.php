<?php

use Skyfiber\Enums\Status;
use Skyfiber\Models\Hookdeck;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Softonic\GraphQL\ClientBuilder;

require __DIR__ . '/vendor/autoload.php';

$env = Dotenv\Dotenv::createImmutable(__DIR__);
$env->load();

$app = AppFactory::create();
$app->addRoutingMiddleware();
$errorMiddleware = $app->addErrorMiddleware($_ENV['DEBUG'], true, true);

// Define app routes
$app->post('/', function (Request $request, Response $response) {
    $hookdeck = new Hookdeck();
    try {
        $hookdeck->isValid($request);

        /**
         * Signature verification successful - proceed with loading form and model
         */
        $formName = '\\Skyfiber\\Models\\Forms\\' . $request->getHeaderLine('x-skyfiber-form');
        $form = new $formName(json_decode($request->getBody(), true));

        $client = ClientBuilder::build(
            $_ENV['SONAR_URL'],
            ['headers' => ['Authorization' => 'Bearer ' . $_ENV['SONAR_TOKEN']]]
        );

        /**
         * Create public ticket mutation
         * @see https://api.sonar.software/createpublicticketmutationinput.doc.html
         */
        $mutation = 'mutation ($input: CreatePublicTicketMutationInput!){
              createPublicTicket (input: $input) {
                id
              }
            }';

        $variables = [
            'input' => [
                'subject' => $form->getSubject(),
                'description' => (string)$form,
                'status' => Status::OPEN,
                'priority' => $form->getPriority(),
                'inbound_mailbox_id' => $form->getInboundMailboxId(),
                'ticket_group_id' => $form->getTicketGroupId(),
                'ticket_recipients' => [
                    ['name' => $form->name, 'email_address' => $form->email],
                ]
            ]
        ];

        /**
         * Call Sonar API
         */
        $sonarResponse = $client->query($mutation, $variables);

        /**
         * If API threw errors pass them back
         */
        if ($sonarResponse->hasErrors()) {
            $response->getBody()->write('Sonar encountered an error. ' . implode($sonarResponse->getErrors()));
            return $response->withStatus(500);
        }

        $publicTicket = $sonarResponse->getData();

        return $response->getBody()->write(
            'Sonar call successful with ticket ID ' . $publicTicket['createPublicTicket']['id']
        );
    } catch (\Exception $e) {
        $response->getBody()->write($e->getMessage());
        return $response->withStatus($e->getCode());
    }
});


// Run app
$app->run();