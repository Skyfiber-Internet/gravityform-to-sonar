<?php declare(strict_types=1);

namespace Skyfiber\Models\Forms;

use Skyfiber\Enums\InboundMailbox;
use Skyfiber\Enums\Priority;
use Skyfiber\Enums\TicketGroup;
use Skyfiber\Interfaces\SonarFieldRequirements;
use Skyfiber\Models\Base;

class Support extends Base implements SonarFieldRequirements
{
    public string $email;
    public string $phone;
    public string $message;

    /**
     * @inheritDoc
     */
    public function __construct($args = [])
    {
        // named attribute = identifier from gravity form
        $args['name'] = $args['6'];
        $args['email'] = $args['2'];
        $args['phone'] = $args['3'];
        $args['message'] = $args['5'];
        $args['company'] = $args['4'];
        parent::__construct($args);
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): Priority
    {
        return Priority::LOW;
    }

    /**
     * @inheritDoc
     */
    public function getInboundMailboxId(): InboundMailbox
    {
        return InboundMailbox::SUPPORT;
    }

    /**
     * @inheritDoc
     */
    public function getTicketGroupId(): TicketGroup
    {
        return TicketGroup::SUPPORT;
    }
}