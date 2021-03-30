<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330103614 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE im2021_panier --Panier de l\'utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER NOT NULL, produit_id INTEGER NOT NULL, qte INTEGER NOT NULL)');
        $this->addSql('CREATE INDEX IDX_2129058FFB88E14F ON im2021_panier (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_2129058FF347EFB ON im2021_panier (produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE im2021_panier');
    }
}
