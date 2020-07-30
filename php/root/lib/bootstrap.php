<?php declare(strict_types = 1);

require_once "Database.php";
require_once "User.php";
require_once "UserGateway.php";
require_once "MessageGateway.php";

// config constants
$HOST = 'db';
$USER = 'devuser';
$PASS = 'devpass';
$DB = 'test_db';

// connect to the Database
$connection = (new Database($HOST, $DB, $USER, $PASS))->GetConnection();

// initialize Gateway objects for interacting with the DB Tables
$userGateway = new UserGateway($connection);
$messageGateway = new MessageGateway($connection);

// initialize the DB Tables
$userGateway->CreateTable();
$messageGateway->CreateTable();

// basic headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


?>