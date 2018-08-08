<?php

namespace App\Domain;


interface DeviceRepository
{
    public function create(Device $device): void;
    public function getById(string $id): Device;
    public function list(): array;
}
