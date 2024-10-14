<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241014093428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE distance DROP FOREIGN KEY FK_1C929A814928641B');
        $this->addSql('DROP INDEX IDX_1C929A814928641B ON distance');
        $this->addSql('ALTER TABLE distance ADD la_ville_id INT DEFAULT NULL, CHANGE les_entrepots_id le_entrepot_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A8133A46488 FOREIGN KEY (le_entrepot_id) REFERENCES entrepot (id)');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A81609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_1C929A8133A46488 ON distance (le_entrepot_id)');
        $this->addSql('CREATE INDEX IDX_1C929A81609A8BA5 ON distance (la_ville_id)');
        $this->addSql('ALTER TABLE entrepot DROP FOREIGN KEY FK_D805175A609A8BA5');
        $this->addSql('DROP INDEX IDX_D805175A609A8BA5 ON entrepot');
        $this->addSql('ALTER TABLE entrepot DROP la_ville_id');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3F399C824');
        $this->addSql('DROP INDEX IDX_43C3D9C3F399C824 ON ville');
        $this->addSql('ALTER TABLE ville DROP les_distances_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE distance DROP FOREIGN KEY FK_1C929A8133A46488');
        $this->addSql('ALTER TABLE distance DROP FOREIGN KEY FK_1C929A81609A8BA5');
        $this->addSql('DROP INDEX IDX_1C929A8133A46488 ON distance');
        $this->addSql('DROP INDEX IDX_1C929A81609A8BA5 ON distance');
        $this->addSql('ALTER TABLE distance ADD les_entrepots_id INT DEFAULT NULL, DROP le_entrepot_id, DROP la_ville_id');
        $this->addSql('ALTER TABLE distance ADD CONSTRAINT FK_1C929A814928641B FOREIGN KEY (les_entrepots_id) REFERENCES entrepot (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_1C929A814928641B ON distance (les_entrepots_id)');
        $this->addSql('ALTER TABLE entrepot ADD la_ville_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE entrepot ADD CONSTRAINT FK_D805175A609A8BA5 FOREIGN KEY (la_ville_id) REFERENCES ville (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D805175A609A8BA5 ON entrepot (la_ville_id)');
        $this->addSql('ALTER TABLE ville ADD les_distances_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3F399C824 FOREIGN KEY (les_distances_id) REFERENCES distance (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_43C3D9C3F399C824 ON ville (les_distances_id)');
    }
}
