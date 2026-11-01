<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20261026103207 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__forecast AS SELECT id, date, wind, precipitation, cloudiness, moisture, temperature, location_id FROM forecast');
        $this->addSql('DROP TABLE forecast');
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL, wind DOUBLE PRECISION NOT NULL, precipitation DOUBLE PRECISION NOT NULL, cloudiness INTEGER NOT NULL, moisture INTEGER NOT NULL, temperature NUMERIC(3, 0) NOT NULL, location_id INTEGER NOT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO forecast (id, date, wind, precipitation, cloudiness, moisture, temperature, location_id) SELECT id, date, wind, precipitation, cloudiness, moisture, temperature, location_id FROM __temp__forecast');
        $this->addSql('DROP TABLE __temp__forecast');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__forecast AS SELECT id, date, wind, precipitation, cloudiness, moisture, temperature, location_id FROM forecast');
        $this->addSql('DROP TABLE forecast');
        $this->addSql('CREATE TABLE forecast (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, date DATE NOT NULL, wind VARCHAR(50) NOT NULL, precipitation VARCHAR(25) NOT NULL, cloudiness VARCHAR(25) NOT NULL, moisture DOUBLE PRECISION NOT NULL, temperature NUMERIC(3, 0) NOT NULL, location_id INTEGER NOT NULL, CONSTRAINT FK_2A9C784464D218E FOREIGN KEY (location_id) REFERENCES location (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO forecast (id, date, wind, precipitation, cloudiness, moisture, temperature, location_id) SELECT id, date, wind, precipitation, cloudiness, moisture, temperature, location_id FROM __temp__forecast');
        $this->addSql('DROP TABLE __temp__forecast');
        $this->addSql('CREATE INDEX IDX_2A9C784464D218E ON forecast (location_id)');
    }
}
