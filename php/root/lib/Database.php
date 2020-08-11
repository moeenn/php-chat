<?php declare(strict_types = 1);

// mySQL db abstraction class using PDO
class Database {
  private object $connection;
  private string $dsn;

  public function __construct(string $host, string $db, string $username, string $passwd) {
    $this->dsn = "mysql:host={$host};dbname={$db}";
    try {
      $this->connection = new PDO($this->dsn, $username, $passwd);
    } catch(PDOException $err) {
      $errMessage = "Error: Connection to the Database Failed!\n" . $err->getMessage(); 
      exit($errMessage);
    }

    // fetch records as associative arrays
    $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // throw exceptions instead of operating silently
    $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function GetConnection() : object {
    return $this->connection;
  }
}

?>