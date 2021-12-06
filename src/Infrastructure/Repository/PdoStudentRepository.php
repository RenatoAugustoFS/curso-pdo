<?php

namespace Alura\Pdo\Infrastructure\Repository;

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Domain\Repository\StudentRepository;
use DateTimeImmutable;
use PDO;

class PdoStudentRepository implements StudentRepository
{
    private PDO $driver;

    public function __construct(PDO $driver)
    {
        $this->driver = $driver;
    }

    public function allStudents(): array
    {
        $stmt = $this->driver->query("SELECT * FROM students");
        return $this->hydrateStudentList($stmt);
    }

    public function studentsBirthAt(\DateTimeInterface $birthDate): array
    {
        $sqlFind = "SELECT * FROM students WHERE birth_date = :birth_date";
        $stmt = $this->driver->prepare($sqlFind);
        $stmt->bindValue('birth_date', $birthDate->format('d/m/Y'));
        $stmt->execute();
        return $this->hydrateStudentList($stmt);
    }

    public function save(Student $student): bool
    {
        if($student->id() === null){
            return $this->insert($student);
        }
        return $this->update($student);
    }

    private function insert(Student $student)
    {
        $sqlInsert = ("INSERT INTO students (name, birth_date) VALUES (:name ,:birth_date);");
        $stmt = $this->driver->prepare($sqlInsert);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('d/m/Y'));
        return $stmt->execute();
    }

    public function update(Student $student)
    {
        $sqlUpdate = ("UPDATE students SET name = ?, birth_date ?  WHERE id = ?;");
        $stmt = $this->driver->prepare($sqlUpdate);
        $stmt->bindValue(':name', $student->name());
        $stmt->bindValue(':birth_date', $student->birthDate()->format('d/m/Y'));
        $stmt->bindValue('id', $student->id());
        return $stmt->execute();
    }

    public function remove(int $id): bool
    {
        $stmt = $this->driver->prepare("DELETE FROM students WHERE id = ?");
        $stmt->bindValue(1, $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    private function hydrateStudentList($stmt): array
    {
        $students = [];
        foreach ($stmt->fetchAll() as $studentData){
            $students[] = new Student(
                $studentData['id'],
                $studentData['name'],
                new DateTimeImmutable($studentData['birth_date'])
            );
        }
        return $students;
    }
}