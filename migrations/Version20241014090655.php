<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014090655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE casier (id INT AUTO_INCREMENT NOT NULL, le_entrepot_id INT DEFAULT NULL, INDEX IDX_3FDF28533A46488 (le_entrepot_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE colis (id INT AUTO_INCREMENT NOT NULL, le_compartiment_id INT DEFAULT NULL, la_ville_id INT DEFAULT NULL, taille VARCHAR(50) NOT NULL, poids DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_470BDFF951442147 (le_compartiment_id), INDEX IDX_470BDFF9609A8BA5 (la_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compartiments (id INT AUTO_INCREMENT NOT NULL, le_casier_id INT DEFAULT NULL, statut VARCHAR(25) NOT NULL, INDEX IDX_B47F3AFFBD210531 (le_casier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrepot (id INT AUTO_INCREMENT NOT NULL, la_ville_id INT DEFAULT NULL, nom VARCHAR(50) NOT NULL, nbr_casier INT NOT NULL, INDEX IDX_D805175A609A8BA5 (la_ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE casier ADD CONSTRAINT FK_3FDF28533A46488 FOREIGN KEY (le_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF951442147 FOREIGN KEY (le_compartiment_id) REFERENCES compartiments (id)');
        $this->addSql('ALTER TABLE colis ADD CONSTRAINT FK_470BDFF9609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE compartiments ADD CONSTRAINT FK_B47F3AFFBD210531 FOREIGN KEY (le_casier_id) REFERENCES casier (id)');
        $this->addSql('ALTER TABLE entrepot ADD CONSTRAINT FK_D805175A609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE casier DROP FOREIGN KEY FK_3FDF28533A46488');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF951442147');
        $this->addSql('ALTER TABLE colis DROP FOREIGN KEY FK_470BDFF9609A8BA5');
        $this->addSql('ALTER TABLE compartiments DROP FOREIGN KEY FK_B47F3AFFBD210531');
        $this->addSql('ALTER TABLE entrepot DROP FOREIGN KEY FK_D805175A609A8BA5');
        $this->addSql('DROP TABLE casier');
        $this->addSql('DROP TABLE colis');
        $this->addSql('DROP TABLE compartiments');
        $this->addSql('DROP TABLE entrepot');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
