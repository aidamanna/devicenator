<?php

namespace App\Infrastructure\Http;

use App\Domain\Device;
use App\Infrastructure\Persistence\MySqlDeviceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListDevices
{
    private $deviceRepository;

    public function __construct(MySqlDeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $exportedDevices = array_map(
            function (Device $device) {
                return $device->export();
            },
            $this->deviceRepository->list()
        );

        return new JsonResponse($exportedDevices);
    }
}
