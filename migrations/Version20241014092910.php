<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014092910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distance (id INT AUTO_INCREMENT NOT NULL, les_entrepots_id INT DEFAULT NULL, kilometres INT NOT NULL, INDEX IDX_1C929A814928641B (les_entrepots_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A814928641B FOREIGN KEY (les_entrepots_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE ville ADD les_distances_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3F399C824 FOREIGN KEY (les_distances_id) REFERENCES distance (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C3F399C824 ON ville (les_distances_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3F399C824');
        $this->addSql('ALTER TABLE distance DROP FOREIGN KEY FK_1C929A814928641B');
        $this->addSql('DROP TABLE distance');
        $this->addSql('DROP INDEX IDX_43C3D9C3F399C824 ON ville');
        $this->addSql('ALTER TABLE ville DROP les_distances_id');
    }
}
