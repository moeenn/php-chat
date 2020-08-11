<?php declare(strict_types = 1);

class User {
  public int $userID;
  public string $userName;
  public string $fullName;
  public string $password;

  public function __construct(array $userDetails) {
    if(isset($userDetails["userName"])){
      $this->userName = (string) $userDetails["userName"];
    } 

    if(isset($userDetails["fullName"])) {
      $this->fullName = (string) $userDetails["fullName"];
    } 

    if(isset($userDetails["password"])){
      $this->password = (string) $userDetails["password"];
    } 

    if (isset($userDetails["userID"])) {
      $this->userID = (int) $userDetails["userID"];
    } else {
      $this->userID = -1;
    }
  }
}

?>