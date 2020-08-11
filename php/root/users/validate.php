<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

if ($context->Method() !== "POST") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
  return;
} 

$body = $context->Body();

if(!$body["userName"] or !$body["password"]) {
  $context->Status(400);
  $context->Send(["error" => "Incomplete Information for user varification"]);
  return;
}

try {
  $userObj = $userGateway->AuthenticateUser($body["userName"], $body["password"]);
} catch (Exception $err) {
  $context->Status(400);
  $context->Send(["error" => "Failed to Authenticate User" ]);
  return;
}

$context->Send($userObj);

?>