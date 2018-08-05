<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20180805162851 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->addSql('CREATE TABLE devices (id VARCHAR(26) NOT NULL UNIQUE, brand VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema) : void
    {
        $this->addSql('DROP TABLE devices');
    }
}
