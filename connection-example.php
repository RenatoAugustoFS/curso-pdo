<?php

$caminhoBanco = __DIR__ . '/banco.sqlite';
$pdo = new PDO('sqlite:' . $caminhoBanco);

$createTableSql = '
    CREATE TABLE IF NOT EXISTS students (
        id INTEGER PRIMARY KEY, 
        name TEXT, 
        birth_date TEXT
    );

    CREATE TABLE IF NOT EXISTS phones (
        id INTEGER PRIMARY KEY, 
        area_code TEXT, 
        number TEXT, 
        student_id INTEGER, 
        FOREIGN KEY(student_id) 
        REFERENCES students(id)
    );

    INSERT INTO phones (area_code, number, student_id) VALUES (21, 26765954, 4);
';

$pdo->exec($createTableSql);