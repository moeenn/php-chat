<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

if ($context->Method() !== "GET") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
  return;
}

// check if the user is already authenticated
session_start();
if (!isset($_SESSION["validatedUser"])) {
  $context->Status(401); // unauthorized
  $context->Send(["error" => "Please login to access this resource"]);
  return;
}

try {
  $users = $userGateway->AllUsers();
} catch (Exception $err) {
  $context->Status(400);
  $context->Send(["error" => "Failed to Create User" ]);
  return;
}

// remove password hashes from the users array
foreach($users as &$user) {
  unset($user["password"]);
}

$context->Send([ "users" => $users ]);

?>