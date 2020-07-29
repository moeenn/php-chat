<?php declare(strict_types = 1);

class User {
  private int $m_userID;
  private string $m_userName;
  private string $m_fullName;
  private string $m_password;

  public function __construct(string $userName, string $fullName, string $passwd, string $id = "-1") {
    $this->m_userName = $userName;
    $this->m_fullName = $fullName;
    $this->m_password = $passwd;
    $this->m_userID = (int) $id;
  }

  // create User object from associative array returned from the DB
  public static function FromArray(array $userArray) : User {
    return new User($userArray["userName"], $userArray["fullName"], $userArray["password"], $userArray["userID"]);
  }

  public function Display() : array {
    return [
      "userID" => $this->m_userID,
      "userName" => $this->m_userName,
      "fullName" => $this->m_fullName,
      "password" => $this->m_password,
    ];
  }
}

?>