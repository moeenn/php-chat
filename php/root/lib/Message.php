<?php declare(strict_types = 1);

class Message {
  public int $messageID;
  public int $senderID;
  public int $recipientID;
  public string $messageText;

  public function __construct(array $msgDetails) {
    if(isset($msgDetails["senderID"])){
      $this->senderID = (int) $msgDetails["senderID"];
    } 

    if(isset($msgDetails["recipientID"])) {
      $this->recipientID = (int) $msgDetails["recipientID"];
    } 

    if(isset($msgDetails["messageText"])){
      $this->messageText = (string) $msgDetails["messageText"];
    } 

    if (isset($msgDetails["messageID"])) {
      $this->messageID = (int) $msgDetails["messageID"];
    } else {
      $this->messageID = -1;
    }
  }
}

?>