<?php
enum Gender: string
{
  case MALE = 'm';
  case FEMALE = 'f';
  case OTHER = 'o';

  public function label(): string
  {
    return match ($this) {
      self::MALE => 'Male',
      self::FEMALE => 'Female',
      self::OTHER => 'Other',
      default => throw new Exception('Invalid gender label'),
    };
  }

  public static function fromValue(string $value): self
  {
    return match ($value) {
      self::MALE->value => self::MALE,
      self::FEMALE->value => self::FEMALE,
      self::OTHER->value => self::OTHER,
      default => throw new Exception('Invalid gender value'),
    };
  }

  public static function values(): array
  {
    return array_column(Gender::cases(), 'value');
  }
}
