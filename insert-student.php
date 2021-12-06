<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$name = $argv[1];
$birth_date = $argv[2];

$student = new Student(null, $name, new DateTimeImmutable($birth_date));
$studentRepository = new PdoStudentRepository($pdo);

if($studentRepository->save($student)){
    echo "Aluno inserido com sucesso";
}