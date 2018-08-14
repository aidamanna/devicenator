<?php

namespace App\Tests\Infrastructure\Http;

use App\Domain\Device;
use App\Infrastructure\Http\GetDevice;
use App\Infrastructure\Persistence\InMemoryDeviceRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class GetDeviceTest extends TestCase
{
    private const DEVICE_ID = '123';

    private $deviceRepository;
    private $response;
    private $device;

    public function testItThrowsAnErrorWhenTheDeviceDoesntExist()
    {
        $this->givenAnEmptyRepository();
        $this->whenGettingADevice();
        $this->thenA404ResponseShouldBeReturned();
    }

    public function testItCanGetADevice()
    {
        $this->givenAnExistingDevice();
        $this->whenGettingADevice();
        $this->thenItShouldBeReturned();
    }

    private function givenAnEmptyRepository(): void
    {
        $this->deviceRepository = new InMemoryDeviceRepository();
    }

    public function whenGettingADevice(): void
    {
        $request = new Request([], [], ['id' => self::DEVICE_ID]);
        $getDevice = new GetDevice($this->deviceRepository);
        $this->response = $getDevice->__invoke($request);
    }

    private function thenA404ResponseShouldBeReturned(): void
    {
        $this->assertEquals(404, $this->response->getStatusCode());
    }

    private function givenAnExistingDevice()
    {
        $this->device = new Device(self::DEVICE_ID, 'Samsung');
        $this->deviceRepository = new InMemoryDeviceRepository();
        $this->deviceRepository->create($this->device);
    }

    private function thenItShouldBeReturned()
    {
        $this->assertEquals(200, $this->response->getStatusCode());
        $this->assertEquals(
            json_decode($this->response->getContent(), true),
            $this->device->export()
        );
    }
}
