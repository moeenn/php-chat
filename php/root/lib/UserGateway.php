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

    // prepare data for insertion into DB
    $userArray = (array) $user;
    unset($userArray["userID"]);
    // hash passwords using BCRYPT before saving to DB
    $userArray["password"] = password_hash($userArray["password"], PASSWORD_DEFAULT);

    try {
      $query = $this->connection->prepare($statement);
      $query->execute($userArray);
    } catch(PDOException $err) {
      $errMessage = "Error: Failed to Create User!\n {$err}";
      throw new Exception($errMessage);
    }

    return (int) $this->connection->lastInsertId();
  }

  // check if provided username / password combo is accurate
  // if yes, return the User Object
  public function AuthenticateUser(string $userName, string $password) : array {
    $statement = <<<EOS
    SELECT * FROM users
    WHERE userName = :userName;
    EOS;
    
    try {
      $query = $this->connection->prepare($statement);
      $query->execute(["userName" => $userName]);
    } catch(PDOException $err) {
      $errMessage = "Error: User not found!\n{$err}";
      throw new Exception($errMessage);
    }

    // get user from the DB (if exists)
    $result = $query->fetch(); 

    if(!$result) {
      $errMessage = "Invalid Username or Password";
      throw new Exception($errMessage);
    }

    // verify password hash
    $isMatch = password_verify($password, $result["password"]);

    if (!$isMatch) {
      $errMessage = "Invalid Username or Password!\n{$err}";
      throw new Exception($errMessage);
    }

    unset($result["password"]);
    return $result;
  }

  public function AllUsers() : array {
    $statement = "SELECT * FROM users;";
    try {
      $query = $this->connection->prepare($statement);
      $query->execute();
    } catch (PDOException $err) {
      $errMessage = "Unable to Fetch all Users\n{$err}";
      throw new Exception($errMessage);
    }

    $users = $query->fetchAll();
    // it is possible that no users exist in the DB
    if(!$users) {
      return [];
    }

    return $users;
  }  
}

?>