<?php

namespace App\Enum;

enum StatusWithdrawEnum: string
{

    case PENDING = 'Pendente';
    case PAID = 'Pago';
    case RECUSED = 'Recusado';

}
