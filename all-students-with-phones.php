<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();
$repository = new PdoStudentRepository($pdo);
$students = $repository->studentsWithPhones();
var_dump($students);