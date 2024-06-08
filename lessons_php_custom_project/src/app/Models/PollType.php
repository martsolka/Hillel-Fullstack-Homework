<?php

namespace app\Models;

use app\Enums\PollTypeStatus;

class PollType extends AbstractModel
{
  const DEFAULT_STATUS = PollTypeStatus::DRAFT->value;

  protected function tableName(): string
  {
    return 'poll_types';
  }

  public function status(): PollTypeStatus
  {
    return PollTypeStatus::from($this->attributes['status'] ?? self::DEFAULT_STATUS);
  }

  public function questions(): array
  {
    return PollTypeQuestion::wherePollTypeId($this->attributes['id']);
  }
}
