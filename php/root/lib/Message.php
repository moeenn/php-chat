<?php declare(strict_types = 1);

class Message {
  public int $messageID;
  public int $senderID;
  public int $recipientID;
  public string $messageText;

  public function __construct(string $senderID, string $recipientID, string $message, string $id = "-1") {
    $this->messageID = (int) $id;
    $this->senderID = (int) $senderID;
    $this->recipientID = (int) $recipientID;
    $this->messageText = $message;
  }

  // create Message object from associative array returned from the DB
  public static function FromArray(array $messageArray) : Message {
    return new Message($messageArray["senderID"], $messageArray["recipientID"], $messageArray["messageText"], $messageArray["messageID"]);
  }

  public function Display() : array {
    return [
      // "messageID" => $this->messageID,
      "senderID" => $this->senderID,
      "recipientID" => $this->recipientID,
      "messageText" => $this->messageText,
    ];
  }
}

?>