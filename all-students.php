<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$studentsRepository = new PdoStudentRepository($pdo);
$students = $studentsRepository->allStudents();

var_dump($students);
