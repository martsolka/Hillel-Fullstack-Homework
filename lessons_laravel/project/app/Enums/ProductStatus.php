<?php

namespace App\Enums;

enum ProductStatus: string
{
    case IN_STOCK = 'in_stock';
    case SOLD_OUT = 'sold_out';
    case DISCONTINUED = 'discontinued';
    case DRAFT = 'draft';

    public function color(): string
    {
        return match ($this) {
            self::IN_STOCK => 'success',
            self::SOLD_OUT => 'danger',
            self::DISCONTINUED => 'warning',
            self::DRAFT => 'light',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::IN_STOCK => '✔ In Stock',
            self::SOLD_OUT => '✘ Sold Out',
            self::DISCONTINUED => '⚠ Discontinued',
            self::DRAFT => '📝 Draft',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
