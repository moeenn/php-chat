<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

// only allow POST requests to this Endpoint
if ($context->Method() !== "POST") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
  return;
} 

$body = $context->Body();

// check if required fields are present in data
if(!$body["senderID"] or !$body["recipientID"] or !$body["messageText"]) {
  $context->Status(400);
  $context->Send(["error" => "Incomplete Information for sending Message"]);
  return;
}

// check if data types are valid
if(gettype($body["senderID"]) !== "integer" or gettype($body["recipientID"]) !== "integer" or gettype($body["messageText"]) !== "string") {
  $context->Status(400);
  $context->Send(["error" => "Invalid Information for sending message"]);
  return;
}

// confirm the messageText length doesn't exceed the Maximum limit
if(strlen($body["messageText"]) > MAX_MESSAGE_LENGTH) {
  $context->Status(400);
  $context->Send(["error" => "Message Text cannot exceed " . MAX_MESSAGE_LENGTH . " characters"]);
  return;
}

// sender must always be the currently validated user
$messageObj = new Message($body);

try {
  $insertID = $messageGateway->SendMessage($messageObj);
} catch (Exception $err) {
  $context->Status(400);
  $context->Send(["error" => "Failed to send Message" . $err->getMessage() ]);
  return;
}

$context->Send(["messageID" => $insertID]);

?>