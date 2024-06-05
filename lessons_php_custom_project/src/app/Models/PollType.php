<?php

namespace app\Models;

use core\PDO;

class PollType
{
  const TABLE_NAME = 'poll_types';
  public static function all(): array
  {
    return PDO::init()->query('SELECT * FROM ' . self::TABLE_NAME)->fetchAll() ?: [];
  }

  public static function find(int $id): array
  {
    $stmt = PDO::init()->prepare('SELECT * FROM ' . self::TABLE_NAME . ' WHERE id = :id');
    $stmt->execute(['id' => $id]);

    return $stmt->fetch() ?: [];
  }
}
