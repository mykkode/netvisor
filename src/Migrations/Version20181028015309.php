<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028015309 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE nodes (id INT IDENTITY NOT NULL, device_id INT, location_id INT, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_1D3D05FC94A4C7D4 ON nodes (device_id)');
        $this->addSql('CREATE INDEX IDX_1D3D05FC64D218E ON nodes (location_id)');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC94A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id)');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC64D218E FOREIGN KEY (location_id) REFERENCES locations (id)');
        $this->addSql('DROP TABLE devices_locations');
        $this->addSql('ALTER TABLE devices DROP COLUMN qr_code');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('CREATE TABLE devices_locations (device_id INT NOT NULL, location_id INT NOT NULL, PRIMARY KEY (device_id, location_id))');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_51CFB57194A4C7D4 ON devices_locations (device_id)');
        $this->addSql('CREATE NONCLUSTERED INDEX IDX_51CFB57164D218E ON devices_locations (location_id)');
        $this->addSql('ALTER TABLE devices_locations ADD CONSTRAINT FK_51CFB57164D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devices_locations ADD CONSTRAINT FK_51CFB57194A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE nodes');
        $this->addSql('ALTER TABLE devices ADD qr_code NVARCHAR(255) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL');
    }
}
