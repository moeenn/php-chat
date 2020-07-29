<?php declare(strict_types = 1);

require_once "lib/bootstrap.php";  
require_once "lib/Context.php";


function main() : void {
  $context = new Context();

  switch($context->Method()) {
    case "POST":
      createUser($context);
      break;

    default:
      $context->Send(["error" => "invalid http method"]);
  }
}

main();

function createUser(Context $context) {
  $context->Send([ "action" => "createUser()" ]);
}

?>