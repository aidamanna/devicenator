<?php

namespace App\Domain;

use Ulid\Ulid;

class Device
{
    private $id;
    private $brand;

    public function __construct(string $id, string $brand)
    {
        $this->id = $id;
        $this->brand = $brand;
    }

    public static function create(string $brand): self
    {
        return new self(Ulid::generate(), $brand);
    }

    public function id(): string
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