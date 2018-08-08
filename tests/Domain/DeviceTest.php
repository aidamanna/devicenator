<?php

namespace App\Tests\Domain;

use App\Domain\Device;
use PHPUnit\Framework\TestCase;

class DeviceTest extends TestCase
{
    public function testThatItCanBeCreatedWithoutAnId()
    {
        $device = Device::create('samsung');

        $this->assertNotEmpty($device->id());
    }

    public function testItCanBeExported()
    {
        $device = new Device('1', 'samsung');

        $this->assertEquals(
            ['id'=>'1', 'brand'=>'samsung'],
            $device->export()
        );
    }
}
