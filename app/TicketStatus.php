<?php

namespace App;

enum TicketStatus: string
{
    case RESERVED = 'reserved';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
}
