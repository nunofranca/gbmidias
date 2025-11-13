<?php

namespace App\Enum;

enum StatusPaymentEnum: string
{

    case PENDING = 'Aguardando Pagamento';
    case PAID = 'Pago';
    case CANCELED = 'Cancelado';

}
