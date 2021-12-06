<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$stmt = $pdo->query("SELECT * FROM students");

while ($studentData = $stmt->fetch()){
    $student = new Student(
        $studentData['id'],
        $studentData['name'],
        new DateTimeImmutable($studentData['birth_date'])
    );

    echo $student->age();
}