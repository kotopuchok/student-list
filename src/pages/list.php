<?php

try {
  $studentGateway = $_SESSION['tableGateway'];
  $password = array_key_exists('password', $_COOKIE) ? strval($_COOKIE['password']) : '';
  $passes = $studentGateway->selectPasses();

  $search = array_key_exists('search', $_GET) ? strval($_GET['search']) : '';
  $sort = array_key_exists('sort', $_GET) ? strval($_GET['sort']) : 'name_asc';
  $page = array_key_exists('page', $_GET) ? intval($_GET['page']) : '1';

  $result = $studentGateway->select($search, $sort, $page);
  $pageCount = ceil($studentGateway->countRows($search, $sort) / 50);

  $linkHelper = new LinkHelper($search, $sort, $page);

  $template = __DIR__ . "/../../public/templates/list-template.html";
  if (file_exists($template)) {
    require_once($template);
  } else {
    throw new Exception("Ошибка, файл $template не существует");
  }
} catch (Exception $e) {
  error_log($e->__toString());
  header("HTTP/1.0 503 Temporary unavailable");
  require_once(__DIR__ . '/../../public/errors/503.html');
  die();
}
