<?php
try {
  $studentGateway = $_SESSION['tableGateway'];
  $studentValidator = new StudentValidator($studentGateway);

  $errors = [];

  $action = array_key_exists('action', $_GET) ? strval($_GET['action']) : '';
  $passes = $studentGateway->selectPasses();

  $student = new Student;

  $sexArray = [
    "Мужской" => "male",
    "Женский" => "female"
  ];

  $originArray = [
    "Местный" => "resident",
    "Иногородний" => "nonresident"
  ];

  $groupArray = [
    "6Н00",
    "Р40Б",
    "ППУ8",
    "9Ч3",
    "ФУ0ЗХ",
    "ВА",
    "109",
    "79Л",
    "ФДЖ",
    "93ХБО",
    "Ю50Х",
    "28И0И",
    "90",
    "ЯЗ",
    "00УЭ",
    "95ЭЛ",
    "ТЗ248"
  ];

  if (!array_key_exists('password', $_COOKIE)) {
    $password = Helper::passGenerate($studentGateway);
    setcookie('password', $password, time() + 60 * 60 * 24 * 30 * 12 * 10, '/', '', false, true);
  } else {
    $password = $_COOKIE['password'];
    setcookie('password', $password, time() + 60 * 60 * 24 * 30 * 12 * 10, '/', '', false, true);
  }

  if (in_array($password, $passes)) {
    $student = $studentGateway->findByPassword($password);
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_COOKIE['password'];
    $token = array_key_exists('password', $_POST) ? strval($_POST['password']) : '';

    if (Helper::isXsrfViolation($password, $token)) {
      throw new Exception("Попытка эксплуатации XSRF");
    }

    Helper::parseStudent($student, $_POST);
    $errors = $studentValidator->validate($student);

    if (!Helper::isErrors($errors)) {
      if (in_array($password, $passes)) {
        $studentGateway->updateRow($student);
      } else {
        $studentGateway->insertRow($student);
      }
      header('Location: /success', true, 303);
      return;
    }
  }

  $template = __DIR__ . "/../../public/templates/profile-template.html";
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
