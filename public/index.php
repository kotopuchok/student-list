<?php
require('../src/init.php');

$router->addNotFoundHandler(function () {
  require_once __DIR__ . "/errors/404.php";
});

$router->get("/", function () {
  require_once __DIR__ . "/../src/pages/list.php";
});

$router->get("/profile", function () {
  require_once __DIR__ . "/../src/pages/profile.php";
});

$router->post("/profile", function () {
  require_once __DIR__ . "/../src/pages/profile.php";
});

$router->get("/success", function () {
  require_once __DIR__ . "/../src/pages/success.php";
});

$router->run();
