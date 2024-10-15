<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241015125313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE taille (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casier ADD le_statut_id INT DEFAULT NULL, DROP statut');
        $this->addSql('ALTER TABLE casier ADD CONSTRAINT FK_3FDF2852F382CF3 FOREIGN KEY (le_statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_3FDF2852F382CF3 ON casier (le_statut_id)');
        $this->addSql('ALTER TABLE colis ADD la_taille_id INT DEFAULT NULL, DROP taille');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF996E4066F FOREIGN KEY (la_taille_id) REFERENCES taille (id)');
        $this->addSql('CREATE INDEX IDX_470BDFF996E4066F ON colis (la_taille_id)');
        $this->addSql('ALTER TABLE compartiments ADD le_statut_id INT DEFAULT NULL, DROP statut');
        $this->addSql('ALTER TABLE compartiments ADD CONSTRAINT FK_B47F3AFF2F382CF3 FOREIGN KEY (le_statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_B47F3AFF2F382CF3 ON compartiments (le_statut_id)');
        $this->addSql('ALTER TABLE entrepot ADD le_statut_id INT DEFAULT NULL, DROP statut');
        $this->addSql('ALTER TABLE entrepot ADD CONSTRAINT FK_D805175A2F382CF3 FOREIGN KEY (le_statut_id) REFERENCES statut (id)');
        $this->addSql('CREATE INDEX IDX_D805175A2F382CF3 ON entrepot (le_statut_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casier DROP FOREIGN KEY FK_3FDF2852F382CF3');
        $this->addSql('ALTER TABLE compartiments DROP FOREIGN KEY FK_B47F3AFF2F382CF3');
        $this->addSql('ALTER TABLE entrepot DROP FOREIGN KEY FK_D805175A2F382CF3');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF996E4066F');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE taille');
        $this->addSql('DROP INDEX IDX_3FDF2852F382CF3 ON casier');
        $this->addSql('ALTER TABLE casier ADD statut VARCHAR(25) NOT NULL, DROP le_statut_id');
        $this->addSql('DROP INDEX IDX_470BDFF996E4066F ON colis');
        $this->addSql('ALTER TABLE colis ADD taille VARCHAR(50) NOT NULL, DROP la_taille_id');
        $this->addSql('DROP INDEX IDX_B47F3AFF2F382CF3 ON compartiments');
        $this->addSql('ALTER TABLE compartiments ADD statut VARCHAR(25) NOT NULL, DROP le_statut_id');
        $this->addSql('DROP INDEX IDX_D805175A2F382CF3 ON entrepot');
        $this->addSql('ALTER TABLE entrepot ADD statut VARCHAR(25) NOT NULL, DROP le_statut_id');
    }
}
