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
$userObj = new User($body);

try {
  $insertID = $userGateway->CreateUser($userObj);
} catch (Exception $err) {
  $context->Status(400);
  $context->Send(["error" => "Failed to Create User" ]);
  return;
}

$context->Send([ "userID" => $insertID ]);

?>