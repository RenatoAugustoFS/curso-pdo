<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$birthDate = $argv[1];

$pdo = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($pdo);
$students = $studentRepository->studentsBirthAt(new DateTimeImmutable($birthDate));
var_dump($students);