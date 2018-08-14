<?php

namespace App\Infrastructure\Persistence;


use App\Domain\Device;
use App\Domain\DeviceRepository;
use App\Domain\UnknownDeviceId;

class InMemoryDeviceRepository implements DeviceRepository
{
    private $devices;

    public function __construct()
    {
        $this->devices = [];
    }

    public function create(Device $device): void
    {
        $this->devices[] = $device;
    }

    public function getById(string $id): Device
    {
        foreach ($this->devices as $device) {
            if ($device->id() == $id) {
                return $device;
            }
        }
        throw new UnknownDeviceId();
    }

    public function list(): array
    {
        return $this->devices;
    }
}
