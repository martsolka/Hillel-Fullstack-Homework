<?php

namespace app\Models;

use core\PDO;

abstract class AbstractModel
{
  protected array $attributes = [];

  abstract protected function tableName(): string;

  public function fill(array $attributes): self
  {
    $this->attributes = $attributes;

    return $this;
  }

  public function create(): bool
  {
    $stmt = PDO::init()->prepare(sprintf(
      "INSERT INTO %s (%s) VALUES (%s)",
      $this->tableName(),
      implode(',', array_keys($this->attributes)),
      implode(',', array_map(fn ($value) => ":$value", array_keys($this->attributes)))
    ));

    return $stmt->execute($this->attributes);
  }

  public function update(): bool
  {
    $stmt = PDO::init()->prepare(sprintf(
      "UPDATE %s SET %s WHERE id = :id",
      $this->tableName(),
      implode(',', array_map(fn ($key) => "$key = :$key", array_keys($this->attributes)))
    ));

    return $stmt->execute($this->attributes);
  }

  public static function delete(int $id): bool
  {
    $stmt = PDO::init()->prepare('DELETE FROM ' . self::make()->tableName() . ' WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount() > 0;
  }

  public function __get(string $key)
  {
    return $this->attributes[$key] ?? null;
  }

  public static function make(): self
  {
    return new static();
  }

  public static function all(): array
  {
    return array_map(
      fn ($item) => self::make()->fill($item),
      PDO::init()->query('SELECT * FROM ' . self::make()->tableName())->fetchAll()
    );
  }

  public static function find(int $id): ?self
  {
    $stmt = PDO::init()->prepare('SELECT * FROM ' . self::make()->tableName() . ' WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return $stmt->rowCount() > 0 ? self::make()->fill($stmt->fetch()) : null;
  }
}
