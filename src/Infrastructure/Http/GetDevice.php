<?php

namespace App\Infrastructure\Http;


use App\Domain\DeviceRepository;
use App\Domain\UnknownDeviceId;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetDevice
{
    private $deviceRepository;

    public function __construct(DeviceRepository $deviceRepository)
    {
        $this->deviceRepository = $deviceRepository;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $id = $request->get('id');
            return new JsonResponse($this->deviceRepository->getById($id)->export());
        } catch (UnknownDeviceId $e) {
            return new JsonResponse([], Response::HTTP_NOT_FOUND);
        }
    }
}