<?php
class StudentTableGateway
{
  private $pdo;
  private $sort_list =
  [
    'name_asc' => 'student_name',
    'name_desc' => 'student_name DESC',
    'surname_asc' => 'student_surname',
    'surname_desc' => 'student_surname DESC',
    'group_asc' => 'student_group',
    'group_desc' => 'student_group DESC',
    'points_asc' => 'student_points',
    'points_desc' => 'student_points DESC'
  ];

  public function __construct($pdo)
  {
    $this->pdo = $pdo;
  }

  public function select($search, $sort, $page)
  {
    $offset = ($page - 1) * 50;
    $table = [];

    $sql = "SELECT * FROM student_list
            WHERE concat(student_name,student_surname,student_group,student_points)
              LIKE '%$search%'
            ORDER BY {$this->sort_list[$sort]}
            LIMIT $offset, 50";

    $result = $this->pdo->prepare($sql);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Student');
    while ($row = $result->fetch()) {
      $table[] = $row;
    };
    return $table;
  }

  public function selectPasses()
  {
    $sql = "SELECT student_password 
            FROM student_list";
    $result = $this->pdo->prepare($sql);
    $result->execute();

    $passes = $result->fetchAll(PDO::FETCH_COLUMN);

    return $passes;
  }

  public function selectEmails()
  {
    $sql = "SELECT student_email 
            FROM student_list";
    $result = $this->pdo->prepare($sql);
    $result->execute();

    $emails = $result->fetchAll(PDO::FETCH_COLUMN);

    return $emails;
  }

  public function insertRow(Student $student)
  {
    $sql = "INSERT INTO student_list VALUES
						(:student_id, :student_name, :student_surname,
             :student_sex, :student_group, :student_email, 
             :student_points, :student_birthdate, 
             :student_origin, :student_password)";
    $query = $this->pdo->prepare($sql);

    $query->execute(
      [
        'student_id' => $student->getId(),
        'student_name' => $student->getName(),
        'student_surname' => $student->getSurname(),
        'student_sex' => $student->getSex(),
        'student_group' => $student->getGroup(),
        'student_email' => $student->getEmail(),
        'student_points' => $student->getPoints(),
        'student_birthdate' => $student->getBirthdate(),
        'student_origin' => $student->getOrigin(),
        'student_password' => $student->getPassword()
      ]
    );
  }

  public function updateRow(Student $student)
  {
    $sql = "UPDATE student_list SET
              student_name = :student_name,
              student_surname = :student_surname,
              student_sex = :student_sex,
              student_group = :student_group,
              student_email = :student_email,
              student_points = :student_points,
              student_birthdate = :student_birthdate,
              student_origin =:student_origin
            WHERE student_id =:student_id";
    $query = $this->pdo->prepare($sql);
    $query->execute(
      [
        'student_name' => $student->getName(),
        'student_surname' => $student->getSurname(),
        'student_sex' => $student->getSex(),
        'student_group' => $student->getGroup(),
        'student_email' => $student->getEmail(),
        'student_points' => $student->getPoints(),
        'student_birthdate' => $student->getBirthdate(),
        'student_origin' => $student->getOrigin(),
        'student_id' => $student->getId()
      ]
    );
  }

  public function countRows($search, $sort)
  {
    $sql = "SELECT Count(*)
            FROM student_list
            WHERE concat(student_name,student_surname,student_group,student_points)
              LIKE '%$search%'
            ORDER BY {$this->sort_list[$sort]}";
    $result = $this->pdo->prepare($sql);
    $result->execute();
    $number_of_rows = $result->fetchColumn();
    return $number_of_rows;
  }

  public function findByPassword($password)
  {
    $password = preg_replace("~'~", "\'", $password);
    $password = preg_replace('~"~', '\"', $password);
    $sql = "SELECT *
            FROM student_list
            WHERE `student_password` LIKE '$password'";
    $result = $this->pdo->prepare($sql);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Student');
    $student = $result->fetch();
    return $student;
  }
}
