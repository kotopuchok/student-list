<?php
$configData = parse_ini_file(__DIR__ . "/config.ini", true);
mb_internal_encoding('utf-8');

//autoloadInit
require_once('autoload.php');

//errorHandlerInit
require_once('errorHandler.php');

//pdoInit
$dbData = $configData['db'];

$dsn = 'mysql:host=localhost;dbname=students;charset=utf8';
$user = $dbData['user'];
$password = $dbData['password'];

$pdo = new PDO($dsn, $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET sql_mode = 'STRICT_ALL_TABLES'");

//GatewayInit
$studentGateway = new StudentTableGateway($pdo);
$_SESSION['tableGateway'] = $studentGateway;

//RouterInit
$router = new Router;
