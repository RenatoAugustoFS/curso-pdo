<?php

namespace Alura\Pdo\Domain\Repository;

use Alura\Pdo\Domain\Model\Student;

interface StudentRepository
{
    public function allStudents(): array;

    public function studentsBirthAt(\DateTimeInterface $birthDate): array;

    public function save(Student $student): bool;

    public function remove(int $id): bool;

    public function studentsWithPhones(): array;
}