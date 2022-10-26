<?php

namespace Skyfiber\Enums;

/**
 * Inbound Mailbox Identifiers in Sonar
 */
enum InboundMailbox: int
{
    case SUPPORT = 3;
    case CANCEL = 7;
    case SALES = 2;
}