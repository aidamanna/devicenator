<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateDevice
{
    private $deviceRepository;

    public function __construct()
    {
        $this->deviceRepository = new DeviceRepository();
    }

    public function __invoke(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        if (empty($body['brand'])) {
            return new JsonResponse(['error'=>'Missing required field: brand'], 400);
        }

        $device = new Device($body['brand']);
        $this->deviceRepository->create($device);

        return new JsonResponse($device->export());
    }
}

class DeviceRepository
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