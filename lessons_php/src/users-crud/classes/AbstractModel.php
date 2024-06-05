<?php
abstract class AbstractModel
{
  protected PDO $pdo;
  protected string $table;

  public function __construct(string $table)
  {
    $this->pdo = DBConnection::getPDO();
    $this->table = $table;
  }

  protected function isTableExists(): bool
  {
    $stmt = $this->pdo->query("SHOW TABLES LIKE '{$this->table}'");
    return $stmt->rowCount() > 0;
  }

  protected function exec($query, $params = []): PDOStatement
  {
    try {
      $stmt = $this->pdo->prepare($query);
      $stmt->execute($params);
      return $stmt;
    } catch (PDOException $e) {
      die("Query failed: " . $e->getMessage());
    }
  }

  public function create(array $data): int
  {
    $query = "INSERT INTO `{$this->table}` SET ";
    $query .= implode(', ', array_map(fn ($key) => "`$key` = :$key", array_keys($data)));
    $this->exec($query, $data);

    return (int)$this->pdo->lastInsertId();
  }

  public function read(?int $id = null, array $fields = ['*'], array $where = [], bool $one = false): array
  {
    $fields = implode(', ', array_map(fn ($field) => $field === '*' ? '*' : "`$field`", $fields));
    $query = "SELECT {$fields} FROM `{$this->table}`";

    if (!empty($where)) {
      $query .= " WHERE " . implode(' AND ', array_map(fn ($key) => "`$key` = :$key", array_keys($where), $where));
    }

    if ($id !== null) {
      $query .= " WHERE `id` = :id";
      $where['id'] = $id;
    }
    $stmt = $this->exec($query, $where);

    return ($one || $id) ? ($stmt->fetch() ?: []) : ($stmt->fetchAll() ?: []);
  }

  public function update(int $id, array $data): bool
  {
    unset($data['id']);
    $query = "UPDATE `{$this->table}` SET ";
    $query .= implode(', ', array_map(fn ($key) => "`$key` = :$key", array_keys($data)));
    $query .= " WHERE `id` = :id";
    $data['id'] = $id;
    $stmt = $this->exec($query, $data);

    return $stmt->rowCount() > 0;
  }

  public function delete(int $id): bool
  {
    $query = "DELETE FROM `{$this->table}` WHERE `id` = :id";
    $stmt = $this->exec($query, [':id' => $id]);

    return $stmt->rowCount() > 0;
  }

  public function dropTable(): bool
  {
    $query = "DROP TABLE `{$this->table}`";
    $stmt = $this->exec($query);

    return $stmt->rowCount() > 0;
  }
}
