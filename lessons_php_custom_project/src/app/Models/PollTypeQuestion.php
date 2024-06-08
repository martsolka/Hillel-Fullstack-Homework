<?php

namespace app\Models;

use app\Enums\QuestionType;

class PollTypeQuestion extends AbstractModel
{
  protected function tableName(): string
  {
    return 'poll_type_questions';
  }

  public static function wherePollTypeId(int $id): array
  {
    return parent::whereEqual('poll_type_id', $id);
  }

  public function pollType(): PollType
  {
    return PollType::find($this->attributes['poll_type_id']);
  }

  public function questionType(): QuestionType
  {
    return QuestionType::from($this->attributes['type']);
  }
}
