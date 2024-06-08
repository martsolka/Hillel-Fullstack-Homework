<?php

namespace app\Enums;

enum QuestionType: string
{
  case RATING = 'rating';
  case MULTIPLE_CHOICE = 'multiple_choice';
  case SINGLE_CHOICE = 'single_choice';
  case OPEN_ENDED = 'open_ended';

  public static function values(): array
  {
    return array_column(self::cases(), 'value');
  }

  public function label(): string
  {
    return match ($this) {
      QuestionType::RATING => '🌟 Rating',
      QuestionType::MULTIPLE_CHOICE => '🔢 Multiple choice',
      QuestionType::SINGLE_CHOICE => '🔘 Single choice',
      QuestionType::OPEN_ENDED => '📝 Open ended',
    };
  }
}
