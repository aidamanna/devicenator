<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Device;
use App\Domain\DeviceRepository;
use Doctrine\DBAL\Driver\Connection;
use PDO;

class MySqlDeviceRepository implements DeviceRepository
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function create(Device $device): void
    {
        $sql = 'INSERT INTO devices (id, brand) VALUES (:id, :brand)';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $device->id(), PDO::PARAM_STR);
        $statement->bindValue(':brand', $device->brand(), PDO::PARAM_STR);
        $statement->execute();
    }

    public function getById(string $id): Device
    {
        $sql = 'SELECT id, brand FROM devices WHERE id=:id';

        $statement = $this->connection->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_STR);
        $statement->execute();

        $record = $statement->fetch();

        return new Device($record['id'], $record['brand']);
    }

    public function list(): array
    {
        $sql = 'SELECT id, brand FROM devices';

        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $records = $statement->fetchAll();

        return array_map(
            function (array $record) {
                return new Device($record['id'], $record['brand']);
            },
            $records
        );
    }
}
