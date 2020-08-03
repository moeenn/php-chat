<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

// check if the user is already authenticated
session_start();
if (!isset($_SESSION["validatedUser"])) {
  $context->Status(401); // unauthorized
  $context->Send(["error" => "Please login to access this resource"]);
  return;
}

// only allow POST requests to this endpoint
if ($context->Method() !== "POST") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
  return;
} 

$body = $context->Body();

if(!$body["uid"]) {
  $context->Status(400);
  $context->Send(["error" => "Incomplete Information for fetching conversations"]);
  return;
}

if(gettype($body["uid"]) !== "integer") {
  $context->Status(400);
  $context->Send(["error" => "Invalid Information for fetching conversations"]);
  return;
}

try {
  $validatedUserID = ($_SESSION["validatedUser"])->userID;
  $messageArray = $messageGateway->GetConversation($body["uid"], $validatedUserID);
} catch (Exception $err) {
  $context->Status(400);
  $context->Send(["error" => "Failed to get conversations" ]);
  return;
}

$context->Send($messageArray);

?>