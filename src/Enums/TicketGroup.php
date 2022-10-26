<?php

namespace Skyfiber\Enums;

/**
 * These are the ticket group IDs in Sonar
 */
enum TicketGroup: int
{
    case SUPPORT = 2;
    case CANCEL = 8;
    case SALES = 1;
}