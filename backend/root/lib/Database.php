<?php declare(strict_types = 1);

// mySQL db abstraction class using PDO
class Database {
  private object $m_connection;
  private string $m_dsn;

  public function __construct(string $host, string $db, string $username, string $passwd) {
    try {
      $this->m_host = $host;
      $this->m_dsn = "mysql:host={$host};dbname={$db}";
      $this->m_connection = new PDO($this->m_dsn, $username, $passwd);
    } catch(PDOException $err) {
      $errMessage = "Error: Connection to the Database Failed!\n" . $err->getMessage(); 
      exit($errMessage);
    }

    // fetch records as associative arrays
    $this->m_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // throw exceptions instead of operating silently
    $this->m_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }

  public function GetConnection() : object {
    return $this->m_connection;
  }
}

?>