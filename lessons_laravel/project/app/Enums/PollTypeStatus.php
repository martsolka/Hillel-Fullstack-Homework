<?php

namespace App\Enums;

enum PollTypeStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case DRAFT = 'draft';

    public function color(): string
    {
        return match ($this) {
            PollTypeStatus::ACTIVE => 'success',
            PollTypeStatus::INACTIVE => 'secondary',
            PollTypeStatus::DRAFT => 'warning',
        };
    }

    public function label(): string
    {
        return match ($this) {
            PollTypeStatus::ACTIVE => '🟢 Active',
            PollTypeStatus::INACTIVE => '⚫ Inactive',
            PollTypeStatus::DRAFT => '🟡 Draft',
        };
    }
}
