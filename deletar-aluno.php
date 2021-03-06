<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$id = $argv[1];
$studentRepository = new PdoStudentRepository($pdo);

if($studentRepository->remove($id)){
    echo "Aluno removido!";
}
