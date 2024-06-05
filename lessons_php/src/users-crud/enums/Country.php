<?php
enum Country: string
{
  case CANADA = 'ca';
  case FRANCE = 'fr';
  case GERMANY = 'de';
  case ITALY = 'it';
  case UKRAINE = 'uk';
  case USA = 'us';
  case OTHER = 'other';

  public function label(): string
  {
    return match ($this) {
      self::CANADA => 'Canada',
      self::FRANCE => 'France',
      self::GERMANY => 'Germany',
      self::ITALY => 'Italy',
      self::UKRAINE => 'Ukraine',
      self::USA => 'United States',
      self::OTHER => 'Other',
      default => throw new Exception('Invalid country label'),
    };
  }

  public static function fromValue(string $value): self
  {
    return match ($value) {
      self::CANADA->value => self::CANADA,
      self::FRANCE->value => self::FRANCE,
      self::GERMANY->value => self::GERMANY,
      self::ITALY->value => self::ITALY,
      self::UKRAINE->value => self::UKRAINE,
      self::USA->value => self::USA,
      self::OTHER->value => self::OTHER,
      default => throw new Exception('Invalid country value'),
    };
  }

  public static function values(): array
  {
    return array_column(Country::cases(), 'value');
  }
}
