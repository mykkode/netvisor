<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181028020555 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE issues (id INT IDENTITY NOT NULL, node_id INT, reporter_id INT, assignee_id INT, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_DA7D7F83460D9FD7 ON issues (node_id)');
        $this->addSql('CREATE INDEX IDX_DA7D7F83E1CFE6F5 ON issues (reporter_id)');
        $this->addSql('CREATE INDEX IDX_DA7D7F8359EC7D60 ON issues (assignee_id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83460D9FD7 FOREIGN KEY (node_id) REFERENCES nodes (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F83E1CFE6F5 FOREIGN KEY (reporter_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE issues ADD CONSTRAINT FK_DA7D7F8359EC7D60 FOREIGN KEY (assignee_id) REFERENCES users (id)');
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
        $this->addSql('DROP TABLE issues');
    }
}
