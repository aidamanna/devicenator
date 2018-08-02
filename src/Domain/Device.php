<?php

namespace App\Domain;

class Device
{
    private $id;
    private $brand;

    public function __construct(string $brand)
    {
        $this->id = rand(0, 500);
        $this->brand = $brand;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function export(): array
    {
        return ['id'=>$this->id, 'brand'=>$this->brand];
    }
}