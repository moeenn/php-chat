<?php declare(strict_types = 1);

require_once "Message.php";

class MessageGateway {
  private object $connection;

  public function __construct(object $dbConnection) {
    $this->connection = $dbConnection;
  }

  public function CreateTable() : void {
    $query = <<<EOS
    CREATE TABLE IF NOT EXISTS messages
    (
      messageID INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
      senderID INTEGER NOT NULL,
      recipientID INTEGER NOT NULL,
      messageText VARCHAR (256),
      FOREIGN KEY (senderID) REFERENCES users(userID),
      FOREIGN KEY (recipientID) REFERENCES users(userID)
    );
    EOS;
    
    try {
      $this->connection->query($query);
    } catch (PDOException $err) {
      $errMessage = "Error: Failed to Create Messages Table!\n" . $err->getMessage(); 
      throw new Exception($errMessage);      
    }
  }

  public function GetConversation(int $uid_1, int $uid_2) : array {
    $statement = <<<EOS
    SELECT * FROM messages WHERE 
    senderID = :uid_1 AND recipientID = :uid_2 OR
    senderID = :uid_2 AND recipientID = :uid_1;
    EOS;

    try {
      $query = $this->connection->prepare($statement);
      $query->execute([ "uid_1" => $uid_1, "uid_2" => $uid_2]);
    } catch(PDOException $err) {
      $errMessage = "Error: Failed to Fetch Conversations between UserID {$uid_1} and {$uid_2}\n{$err}";
      throw new Exception($errMessage);
    }

    $result = $query->fetchAll();

    if (!$result) {
      return [];
    }

    return $result;
  }

  public function SendMessage(Message $msg) : int {
    $statement = <<<EOS
    INSERT INTO messages (senderID, recipientID, messageText) 
    VALUES ( :senderID, :recipientID, :messageText);
    EOS;

    try {
      $query = $this->connection->prepare($statement);
      $msgArray = (array) $msg;
      unset($msgArray["messageID"]);
      $query->execute($msgArray);
    } catch(PDOException $err) {
      $errMessage = "Error: Failed to Send Message!\n{$err}";
      throw new Exception($errMessage);
    }

    return (int) $this->connection->lastInsertId();
  }
}

?>