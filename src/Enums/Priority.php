<?php

namespace Skyfiber\Enums;

/**
 * Ticket Priority mappings in Sonar
 */
enum Priority: string
{
    case LOW = 'LOW';
    case MEDIUM = 'MEDIUM';
    case HIGH = 'HIGH';
}