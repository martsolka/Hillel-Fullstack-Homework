<?php

namespace app\Models;

use app\Enums\PollTypeStatus;
use core\PDO;

class PollType
{
  const TABLE_NAME = 'poll_types';
  const DEFAULT_STATUS = PollTypeStatus::DRAFT->value;
  protected array $attributes = [];

  public function fill(array $attributes): self
  {
    $this->attributes = $attributes;

    return $this;
  }

  public function create(): bool
  {
    $stmt = PDO::init()->prepare('INSERT INTO ' . self::TABLE_NAME . ' (name, description, status) VALUES (:name, :description, :status)');

    return $stmt->execute($this->attributes);
  }

  public function status(): PollTypeStatus
  {
    return PollTypeStatus::from($this->attributes['status'] ?? self::DEFAULT_STATUS);
  }

  public function __get(string $key)
  {
    return isset($this->attributes[$key])
      ? ($key === 'status' ? $this->status()->label() : $this->attributes[$key])
      : null;
  }

  public static function make(): self
  {
    return new static();
  }

  public static function all(): array
  {
    return array_map(
      fn ($row) => self::make()->fill($row),
      PDO::init()->query('SELECT * FROM ' . self::TABLE_NAME)->fetchAll() ?: []
    );
  }

  public static function find(int $id): self
  {
    $stmt = PDO::init()->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return self::make()->fill($stmt->fetch() ?: []);
  }
}
