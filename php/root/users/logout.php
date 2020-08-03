<?php declare(strict_types = 1);

require_once "../lib/bootstrap.php";  
require_once "../lib/Context.php";

$context = new Context();

// only allow GET request to this endpoint
if ($context->Method() !== "GET") {
  $context->Status(400); // bad request
  $context->Send(["error" => "invalid http method"]);
  return;
} 

// check if user is logged in 
session_start();

// error if user is not already logged in
if(!isset($_SESSION["validatedUser"])) {
  $context->Status(400);
  $context->Send(["error" => "User must be logged in before they can logout"]);
  return;
}

// logout
unset($_SESSION["validatedUser"]);
$context->Send(["success" => "User logged out successfully"]);

?>