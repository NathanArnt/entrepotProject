<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241017091353 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF951442147');
        $this->addSql('DROP INDEX UNIQ_470BDFF951442147 ON colis');
        $this->addSql('ALTER TABLE colis DROP le_compartiment_id');
        $this->addSql('ALTER TABLE compartiments ADD le_colis_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE compartiments ADD CONSTRAINT FK_B47F3AFF8368A699 FOREIGN KEY (le_colis_id) REFERENCES colis (id)');
        $this->addSql('CREATE INDEX IDX_B47F3AFF8368A699 ON compartiments (le_colis_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE colis ADD le_compartiment_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF951442147 FOREIGN KEY (le_compartiment_id) REFERENCES compartiments (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_470BDFF951442147 ON colis (le_compartiment_id)');
        $this->addSql('ALTER TABLE compartiments DROP FOREIGN KEY FK_B47F3AFF8368A699');
        $this->addSql('DROP INDEX IDX_B47F3AFF8368A699 ON compartiments');
        $this->addSql('ALTER TABLE compartiments DROP le_colis_id');
    }
}
