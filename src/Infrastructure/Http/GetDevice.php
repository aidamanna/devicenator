<?php

namespace App\Infrastructure\Http;


use App\Infrastructure\Persistence\MySqlDeviceRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetDevice
{
    private $deviceRepository;

    public function __construct(MySqlDeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->get('id');
        return new JsonResponse($this->deviceRepository->getById($id)->export());
    }
}