<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Device;

class InMemoryDeviceRepository
{
    private $devices;

    public function __construct()
    {
        $this->devices = [];
    }

    public function create(Device $device): void
    {
        $this->devices[$device->id()] = $device;
    }
}