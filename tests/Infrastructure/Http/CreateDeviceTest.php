<?php

namespace App\Tests\Infrastructure\Http;

use App\Infrastructure\Http\CreateDevice;
use App\Infrastructure\Persistence\InMemoryDeviceRepository;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class CreateDeviceTest extends TestCase
{
    public function testItThrowsAnErrorWhenNoBrandIsGiven()
    {
        $request = new Request();
        $createDevice = new CreateDevice(new InMemoryDeviceRepository());
        $response = $createDevice->__invoke($request);

        $this->assertEquals(400, $response->getStatusCode());
    }

    public function testItCanCreateADevice()
    {
        $request = new Request([], [], [], [], [], [], json_encode(['brand'=>'nexus']));
        $deviceRepository = new InMemoryDeviceRepository();
        $createDevice = new CreateDevice($deviceRepository);
        $response = $createDevice->__invoke($request);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(
           json_decode($response->getContent(), true),
           $deviceRepository->list()[0]->export()
         );
    }

}
