<?php

class StudentValidator
{
  private $studentGateway;

  public function __construct($studentGateway)
  {
    $this->studentGateway = $studentGateway;
  }

  private function validateName($name)
  {
    $pattern = "/^[А-ЯЁ]{1}[а-яёА-ЯЁ' -]*$/u";

    $nameErrors = [];

    if (mb_strlen($name) >= 100) {
      $nameErrors[] = 'Имя должно быть короче 100 символов';
    }

    if (!preg_match($pattern, $name)) {
      $nameErrors[] = 'Имя должно начинаться с большой буквы, может содержать только буквы русского алфавита, дефис, апостроф и пробел';
    }

    return $nameErrors;
  }

  private function validateSurname($surname)
  {
    $pattern = "/^[А-ЯЁ]{1}[а-яёА-ЯЁ' -]*$/u";

    $surnameErrors = [];

    if (mb_strlen($surname) >= 100) {
      $surnameErrors[] = 'Фамилия должна быть короче 100 символов';
    }

    if (!preg_match($pattern, $surname)) {
      $surnameErrors[] = 'Фамилия должна начинаться с большой буквы, может содержать только буквы русского алфавита, дефис, апостроф и пробел';
    }

    return $surnameErrors;
  }

  private function validateEmail($email, $student)
  {
    $emailErrors = [];

    $studentGateway = $this->studentGateway;

    $emails = $studentGateway->selectEmails();

    $password = $student->getPassword();

    $original = $studentGateway->findByPassword($password);

    if (in_array($email, $emails) && $email != $original->getEmail()) {
      $emailErrors[] = 'Данный адрес электронной почты уже кому-то принадлежит';
    }

    return $emailErrors;
  }

  public function validate(Student $student)
  {
    $errors = [];

    $name = $student->getName();
    $surname = $student->getSurname();
    $email = $student->getEmail();

    $nameErrors = $this->validateName($name);
    $surnameErrors = $this->validateSurname($surname);
    $emailErrors = $this->validateEmail($email, $student);

    $errors['name_errors'] = $nameErrors;
    $errors['surname_errors'] = $surnameErrors;
    $errors['email_errors'] = $emailErrors;

    return $errors;
  }
}
