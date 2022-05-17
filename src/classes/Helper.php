<?php

class Helper
{


  static public function passGenerate(StudentTableGateway $studentGateway)
  {
    $passes = $studentGateway->selectPasses();

    do {
      $chars = [];
      for ($i = 0; $i < 32; $i++) {
        $int = mt_rand(33, 126);
        $char = chr($int);
        $chars[] = $char;
      }
      $pass = implode('', $chars);
    } while (in_array($pass, $passes));

    return $pass;
  }

  static public function isXsrfViolation($pass, $cookiePass)
  {
    if ($pass == $cookiePass) {
      return false;
    }
    return true;
  }

  static public function parseStudent(Student $student, $postRequest)
  {
    $id = $student->getId();
    $name = trim(array_key_exists('name', $postRequest) ? strval($postRequest['name']) : '');
    $surname = trim(array_key_exists('surname', $postRequest) ? strval($postRequest['surname']) : '');
    $sex = trim(array_key_exists('sex', $postRequest) ? strval($postRequest['sex']) : '');
    $group = trim(array_key_exists('group', $postRequest) ? strval($postRequest['group']) : '');
    $email = trim(array_key_exists('email', $postRequest) ? strval($postRequest['email']) : '');
    $points = trim(array_key_exists('points', $postRequest) ? intval($postRequest['points']) : 0);
    $birthdate = trim(array_key_exists('birthdate', $postRequest) ? strval($postRequest['birthdate']) : '');
    $origin = trim(array_key_exists('origin', $postRequest) ? strval($postRequest['origin']) : '');
    $password = trim(array_key_exists('password', $postRequest) ? strval($postRequest['password']) : '');

    $student->setStudent($id, $name, $surname, $sex, $group, $email, $points, $birthdate, $origin, $password);
  }

  static public function isErrors($errors)
  {
    $c = 0;
    foreach ($errors as $error) {
      if (!$error) {
        $c++;
      }
    }
    if ($c == count($errors)) {
      return false;
    }
    return true;
  }
}
