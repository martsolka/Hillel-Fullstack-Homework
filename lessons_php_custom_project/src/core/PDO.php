<?php

namespace core;

use \PDO as NativePdo;

class PDO
{
  protected static ?NativePdo $PDO = null;

  public static function init(): NativePdo
  {
    if (!self::$PDO) {
      $config = require __DIR__ . '/../config/database.php';

      $dsn = "mysql:host={$config['host']};dbname={$config['db']};charset={$config['charset']}";
      $opt = [
        NativePdo::ATTR_ERRMODE => NativePdo::ERRMODE_EXCEPTION,
        NativePdo::ATTR_DEFAULT_FETCH_MODE => NativePdo::FETCH_ASSOC,
      ];

      self::$PDO = new NativePdo($dsn, $config['user'], $config['pass'], $opt);
    }

    return self::$PDO;
  }
}
