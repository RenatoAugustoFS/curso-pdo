<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$name = $argv[1];
$birth_date = $argv[2];
$name2 = $argv[3];
$birth_date2 = $argv[4];

$student = new Student(null, $name, new DateTimeImmutable($birth_date));
$anotherStudent = new Student(null, $name2, new DateTimeImmutable($birth_date2));

$pdo->beginTransaction();

try {
    $studentRepository = new PdoStudentRepository($pdo);
    $studentRepository->save($student);
    $studentRepository->save($anotherStudent);
    $pdo->commit();
} catch (PDOException $exception){
    echo $exception->getMessage();
    $pdo->rollBack();
}
