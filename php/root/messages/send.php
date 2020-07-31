<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

// check if the user is already authenticated
session_start();
if (!isset($_SESSION["validatedUser"])) {
  $context->Status(401); // unauthorized
  $context->Send(["error" => "Please login to access this resource"]);
  exit(0);
}

// only allow POST requests to this Endpoint
if ($context->Method() !== "POST") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
} else {
  $body = $context->Body();

  if(!$body["senderID"] or !$body["recipientID"] or !$body["messageText"] ) {
    $context->Status(400);
    $context->Send(["error" => "Incomplete Information for sending Message"]);
    return;
  }

  if(gettype($body["senderID"]) !== "integer" or gettype($body["recipientID"]) !== "integer" or gettype($body["messageText"]) !== "string") {
    $context->Status(400);
    $context->Send(["error" => "Invalid Information for sending message"]);
    return;
  }

  $messageObj = new Message($body);

  try {
    $insertID = $messageGateway->SendMessage($messageObj);
  } catch (Exception $err) {
    $context->Status(400);
    $context->Send(["error" => "Failed to send Message" . $err->getMessage() ]);
    return;
  }

  $context->Send(["messageID" => $insertID]);
}

?>