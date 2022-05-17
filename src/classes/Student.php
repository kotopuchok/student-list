<?php

class Student
{
  const SEX_MALE = 'male';
  const SEX_FEMALE = 'female';
  const ORIGIN_RESIDENT = 'resident';
  const ORIGIN_NONRESIDENT = 'nonresident';

  private $student_id = NULL;
  private $student_name;
  private $student_surname;
  private $student_sex;
  private $student_group;
  private $student_email;
  private $student_points;
  private $student_birthdate;
  private $student_origin;
  private $student_password;

  //Setters
  public function setStudent(
    $id,
    string $name,
    string $surname,
    string $sex,
    string $group,
    string $email,
    int $points,
    string $birthdate,
    string $origin,
    string $password,
  ) {
    $this->student_id = $id;
    $this->student_name = $name;
    $this->student_surname = $surname;
    $this->student_sex = $sex;
    $this->student_group = $group;
    $this->student_email = $email;
    $this->student_points = $points;
    $this->student_birthdate = $birthdate;
    $this->student_origin = $origin;
    $this->student_password = $password;
  }

  public function setId($id)
  {
    $this->student_id = $id;
  }

  public function setName($name)
  {
    $this->student_name = $name;
  }

  public function setSurname($surname)
  {
    $this->student_surname = $surname;
  }

  public function setSex($sex)
  {
    $this->student_sex = $sex;
  }

  public function setGroup($group)
  {
    $this->student_group = $group;
  }

  public function setEmail($email)
  {
    $this->student_email = $email;
  }

  public function setPoints($points)
  {
    $this->student_points = $points;
  }

  public function setBirthdate($birthdate)
  {
    $this->student_birthdate = $birthdate;
  }

  public function setOrigin($origin)
  {
    $this->student_origin = $origin;
  }

  public function setPassword($password)
  {
    $this->student_password = $password;
  }

  //Getters 
  public function getId()
  {
    return $this->student_id;
  }

  public function getName()
  {
    return $this->student_name;
  }

  public function getSurname()
  {
    return $this->student_surname;
  }

  public function getSex()
  {
    return $this->student_sex;
  }

  public function getGroup()
  {
    return $this->student_group;
  }

  public function getEmail()
  {
    return $this->student_email;
  }

  public function getPoints()
  {
    return $this->student_points;
  }

  public function getBirthdate()
  {
    return $this->student_birthdate;
  }

  public function getOrigin()
  {
    return $this->student_origin;
  }

  public function getPassword()
  {
    return $this->student_password;
  }
}
