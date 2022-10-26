# SkyFiber Webhooks - Gravity Forms

This repo assists with the Gravity Forms that are in WordPress for SkyFiber. The application is based off of the [Slim
Framework](https://www.slimframework.com/). It uses GraphQL to communicate with the [Sonar API](https://api.sonar.software/)
Everything is written in PHP 8.1 and the tests are written using PHPUnit.

#### Steps to configure Gravity Forms

There is only one route configured `/` "root". Here is what I did to configure the Gravity Form submission.

1. Configure Gravity Forms to [post a webhook](https://www.gravityforms.com/add-ons/webhooks/) to the [Hookdeck](https://hookdeck.com/) (Hookdeck is great for visibility into your webhooks)
   1. Gravity Forms will need `Authorization` setup if you plan to use the [Hookdeck validation feature](https://hookdeck.com/webhooks/guides/what-are-the-webhook-authentication-strategies#basic-authentication) (recommended)
   2. Gravity Forms will need a `x-skyfiber-form` header as well - This will match with the `src/Models/Forms` to the mapping is done correctly
2. Configure Hookdeck to post to your PHP site `yoursite.com/webhook` as an example
3. Create a copy of the `src/Models/Forms` php file to match your Gravity Form
   1. Map your properties: You will need to create the properties for the form to match Gravity Form. If your Gravity Form is capturing "How
   did you hear about us?" and the ID is 10. Your attribute could be named `$referral` and the `__construct($args){}`
   would be named `$args['referral'] = $args['10'];`
4. Update the forms `Priority`, `InboundMailbox`, and `TicketGroup` using the Enums listed at `src/Enums`.

```
Note: You should not have to change anything on the /index.php file path. Hookdeck.php will use reflection to check
the file Forms that exist for validation.
```


#### Testing locally

Git clone the project and run the following:

1. `composer install`
2. Copy `.env.example` to `.env` and change the parameters as necessary
3. `./vendor/bin/phpunit tests` - this command runs all unit tests
4. `php -S localhost:8000` - this runs a local web server for testing
5. `hookdeck listen 8000` - runs [Hookdeck CLI](https://hookdeck.com/docs/using-the-cli) to test your webhooks