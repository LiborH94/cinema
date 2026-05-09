<?php

namespace App;

enum CartStatus: string
{
    case ACTIVE = 'active';
    case COMPLETED = 'completed';
    case EXPIRED = 'expired';
}
