<?php
enum Role: string
{
  case ROOT = 'r';
  case ADMIN = 'a';
  case MODERATOR = 'm';
  case TEACHER = 't';
  case STUDENT = 's';

  public function bsClass(): string
  {
    $color = match ($this) {
      self::ROOT => 'danger',
      self::ADMIN => 'primary',
      self::MODERATOR => 'info',
      self::TEACHER => 'success',
      self::STUDENT => 'warning',
      default => throw new Exception('Invalid role color'),
    };

    return "badge bg-gradient bg-{$color}-subtle text-{$color}-emphasis";
  }

  public function label(): string
  {
    return match ($this) {
      self::ROOT => 'Main Administrator',
      self::ADMIN => 'Administrator',
      self::MODERATOR => 'Moderator',
      self::TEACHER => 'Teacher',
      self::STUDENT => 'Student',
      default => throw new Exception('Invalid role label'),
    };
  }

  public static function fromValue(string $value): self
  {
    return match ($value) {
      self::ROOT->value => self::ROOT,
      self::ADMIN->value => self::ADMIN,
      self::MODERATOR->value => self::MODERATOR,
      self::TEACHER->value => self::TEACHER,
      self::STUDENT->value => self::STUDENT,
      default => throw new Exception('Invalid role value'),
    };
  }

  public static function values(): array
  {
    return array_column(Role::cases(), 'value');
  }

  public static function withoutRoot(bool $values = false): array
  {
    if ($values) {
      return array_filter(static::values(), fn ($role) => $role !== self::ROOT->value);
    }

    return array_filter(self::cases(), fn ($role) => $role->value !== self::ROOT->value);
  }
}
