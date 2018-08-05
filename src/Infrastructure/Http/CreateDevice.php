<?php

namespace App\Infrastructure\Http;

use App\Domain\Device;
use App\Infrastructure\Persistence\MySqlDeviceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateDevice
{
    private $deviceRepository;

    public function __construct(MySqlDeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        if (empty($body['brand'])) {
            return new JsonResponse(['error'=>'Missing required field: brand'], 400);
        }

        $device = Device::create($body['brand']);
        $this->deviceRepository->create($device);

        return new JsonResponse($device->export());
    }
}
