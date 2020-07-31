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

// only allow POST requests to this endpoint
if ($context->Method() !== "POST") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
} else {
  $body = $context->Body();

  if(!$body["uid_1"] or !$body["uid_2"] ) {
    $context->Status(400);
    $context->Send(["error" => "Incomplete Information for fetching conversations"]);
    return;
  }

  if(gettype($body["uid_1"]) !== "integer" or gettype($body["uid_2"]) !== "integer") {
    $context->Status(400);
    $context->Send(["error" => "Invalid Information for fetching conversations"]);
    return;
  }

  try {
    $messageArray = $messageGateway->GetConversation($body["uid_1"], $body["uid_2"]);
  } catch (Exception $err) {
    $context->Status(400);
    $context->Send(["error" => "Failed to get conversations" ]);
    return;
  }

  $context->Send($messageArray);
}

?>