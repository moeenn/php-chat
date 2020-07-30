<?php declare(strict_types = 1);

require_once "User.php";

class UserGateway {
  private object $connection;

  public function __construct(object $dbConnection) {
    $this->connection = $dbConnection;
  }

  public function CreateTable() : void {
    $query = <<<EOS
    CREATE TABLE IF NOT EXISTS users 
    (
      userID INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
      userName VARCHAR (256) UNIQUE NOT NULL,
      fullName VARCHAR (256) NOT NULL,
      password VARCHAR (256) NOT NULL
    );
    EOS;

    try {
      $this->connection->query($query);
    } catch (PDOException $err) {
      $errMessage = "Error: Failed to Create Users Table!\n" . $err->getMessage(); 
      throw new Exception($errMessage);      
    }
  }

  // returns ID of newly created user
  public function CreateUser(User $user) : int {
    $statement = <<<EOS
    INSERT INTO users (userName, fullName, password)
    VALUES ( :userName, :fullName, :password);
    EOS;

    try {
      $query = $this->connection->prepare($statement);
      $userArray = (array) $user;
      unset($userArray["userID"]);
      $query->execute($userArray);
    } catch(PDOException $err) {
      $errMessage = "Error: Failed to Create User!\n {$err}";
      throw new Exception($errMessage);
    }

    return (int) $this->connection->lastInsertId();
  }

  // check if provided username / password combo is accurate
  // if yes, return the User Object
  public function AuthenticateUser(string $userName, string $password) : User {
    $statement = <<<EOS
    SELECT * FROM users
    WHERE userName = :userName and password = :password;
    EOS;
    
    try {
      $query = $this->connection->prepare($statement);
      $query->execute(["userName" => $userName, "password" => $password]);
    } catch(PDOException $err) {
      $errMessage = "Error: Invalid Username or Password!\n{$err}";
      throw new Exception($errMessage);
    }

    $result = $query->fetch(); 
    if (!$result) {
      $errMessage = "Error: Invalid Username or Password!\n{$err}";
      throw new Exception($errMessage);
    }

    return new User($result);
  }
}

?>