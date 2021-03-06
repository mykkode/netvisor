<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028052245 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FC64D218E');
        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FC94A4C7D4');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC64D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC94A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id) ON DELETE CASCADE');
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
        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FC94A4C7D4');
        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FC64D218E');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC94A4C7D4 FOREIGN KEY (device_id) REFERENCES devices (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC64D218E FOREIGN KEY (location_id) REFERENCES locations (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
    }
}
