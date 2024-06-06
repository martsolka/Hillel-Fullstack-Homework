<?php

namespace app\Enums;

enum PollTypeStatus: string
{
    case ACTIVE = 'active';
    case ARCHIVED = 'archived';
    case DRAFT = 'draft';

    public function color(): string
    {
        return match ($this) {
            PollTypeStatus::ACTIVE => 'success',
            PollTypeStatus::ARCHIVED => 'secondary',
            PollTypeStatus::DRAFT => 'warning',
        };
    }

    public function label(): string
    {
        return match ($this) {
            PollTypeStatus::ACTIVE => '🟢 Active',
            PollTypeStatus::ARCHIVED => '⚫ Archived',
            PollTypeStatus::DRAFT => '🟡 Draft',
        };
    }

    public static function forSelect(PollTypeStatus ...$excluded): array
    {
        return array_reduce(self::cases(), function ($carry, $case) use ($excluded) {
            return in_array($case, $excluded) ? $carry : array_merge($carry, [$case->value => $case->label()]);
        }, []);
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
