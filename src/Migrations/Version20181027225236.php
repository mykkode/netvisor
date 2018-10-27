<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181027225236 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE locations (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE devices (id INT IDENTITY NOT NULL, name NVARCHAR(255) NOT NULL, qr_code NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE devices_locations (device_id INT NOT NULL, location_id INT NOT NULL, PRIMARY KEY (device_id, location_id))');
        $this->addSql('CREATE INDEX IDX_51CFB57194A4C7D4 ON devices_locations (device_id)');
        $this->addSql('CREATE INDEX IDX_51CFB57164D218E ON devices_locations (location_id)');
        $this->addSql('ALTER TABLE devices_locations ADD CONSTRAINT FK_51CFB57194A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE devices_locations ADD CONSTRAINT FK_51CFB57164D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE devices_locations DROP CONSTRAINT FK_51CFB57164D218E');
        $this->addSql('ALTER TABLE devices_locations DROP CONSTRAINT FK_51CFB57194A4C7D4');
        $this->addSql('DROP TABLE locations');
        $this->addSql('DROP TABLE devices');
        $this->addSql('DROP TABLE devices_locations');
    }
}
