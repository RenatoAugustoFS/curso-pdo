<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$name = $argv[1];
$birth_date = $argv[2];

$student = new Student(null, $name, new DateTimeImmutable($birth_date));
$sqlInsert = ("INSERT INTO students (name, birth_date) VALUES (:name ,:birth_date);");
$stmt = $pdo->prepare($sqlInsert);
$stmt->bindValue(':name', $student->name());
$stmt->bindValue(':birth_date', $student->birthDate()->format('d/m/Y'));

$stmt->execute();