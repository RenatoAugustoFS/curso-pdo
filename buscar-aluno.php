<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$sqlSelect = ("SELECT * FROM students");
$stmt = $pdo->query($sqlSelect);

$students = [];
foreach ($stmt->fetchAll() as $studentData){
    $students[] = new Student($studentData['id'], $studentData['name'], new DateTimeImmutable($studentData['birth_date']));
}

var_dump($students);
