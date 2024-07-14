<?php

declare(strict_types=1);

namespace App\Order\Repository\Filters;

enum Source: string
{
    case AMAZON = 'amazon';
    case EBAY = 'ebay';
}
