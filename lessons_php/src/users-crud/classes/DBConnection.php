<?php
class DBConnection
{
  private static ?self $instance = null;
  private PDO $pdo;
  private $config = [
    'host' => 'db',
    'dbName' => 'php-app',
    'username' => 'hillel',
    'password' => 'secret',
    'charset' => 'utf8'
  ];

  private function __construct()
  {
    try {
      $dsn = "mysql:host={$this->config['host']};dbname={$this->config['dbName']};charset={$this->config['charset']}";
      $opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ];
      $this->pdo = new PDO($dsn, $this->config['username'], $this->config['password'], $opt);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public static function getPDO(): PDO
  {
    if (self::$instance == null) {
      self::$instance = new self();
    }

    return self::$instance->pdo;
  }
}
