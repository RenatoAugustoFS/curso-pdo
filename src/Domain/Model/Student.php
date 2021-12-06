<?php

namespace Alura\Pdo\Domain\Model;

class Student
{
    private ?int $id;
    private string $name;
    private \DateTimeInterface $birthDate;
    private array $phones;

    public function __construct(?int $id, string $name, \DateTimeInterface $birthDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this->phones = [];
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function defineId(int $id): void
    {
        if(!is_null($this->id)){
            throw new \DomainException("Você só pode definir o ID uma única vez");
        }

        $this->id = $id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function changeName(string $newName): void
    {
        $this->name = $newName;
    }

    public function birthDate(): \DateTimeInterface
    {
        return $this->birthDate;
    }

    public function age(): int
    {
        return $this->birthDate
            ->diff(new \DateTimeImmutable())
            ->y;
    }

    public function addPhone(Phone $phone): self
    {
        $this->phones[] = $phone;
        return $this;
    }

    public function phones(): array
    {
        return $this->phones;
    }
}
