<?php declare(strict_types = 1);

class Message {
  public int $m_messageID;
  public int $m_senderID;
  public int $m_recipientID;
  public string $m_messageText;

  public function __construct(string $senderID, string $recipientID, string $message, string $id = "-1") {
    $this->m_messageID = (int) $id;
    $this->m_senderID = (int) $senderID;
    $this->m_recipientID = (int) $recipientID;
    $this->m_messageText = $message;
  }

  // create Message object from associative array returned from the DB
  public static function FromArray(array $messageArray) : Message {
    return new Message($messageArray["senderID"], $messageArray["recipientID"], $messageArray["messageText"], $messageArray["messageID"]);
  }

  public function Display() : array {
    return [
      // "messageID" => $this->m_messageID,
      "senderID" => $this->m_senderID,
      "recipientID" => $this->m_recipientID,
      "messageText" => $this->m_messageText,
    ];
  }
}

?>