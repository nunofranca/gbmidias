<?php

namespace App\Enum;

enum StatusPaymentEnum: string
{

    case PENDING = 'waiting';
    case PAID = 'paid';
    case CANCELED = 'canceled';

}
