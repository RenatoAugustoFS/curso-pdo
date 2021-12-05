<?php

use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once "vendor/autoload.php";

$pdo = ConnectionCreator::createConnection();

$id = $argv[1];
$stmt = $pdo->prepare("DELETE FROM students WHERE id = ?");
$stmt->bindValue(1, $id);
$stmt->execute();