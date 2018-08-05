<?php

namespace App\Infrastructure\Http;

use App\Infrastructure\Persistence\InMemoryDeviceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ListDevices
{
    private $deviceRepository;

    public function __construct(InMemoryDeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse($this->deviceRepository->list());
    }
}