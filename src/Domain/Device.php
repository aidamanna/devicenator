<?php

namespace App\Domain;

class Device
{
    private $id;
    private $brand;

    public function __construct(int $id, string $brand)
    {
        $this->id = $id;
        $this->brand = $brand;
    }

    public static function create(string $brand): self
    {
        return new self(rand(0, 500), $brand);
    }

    public function id(): int
    {
        return $this->id;
    }

    public function brand(): string
    {
        return $this->brand;
    }

    public function export(): array
    {
        return ['id'=>$this->id, 'brand'=>$this->brand];
    }
}