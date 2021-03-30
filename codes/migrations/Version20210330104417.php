<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330104417 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2129058FF347EFB');
        $this->addSql('DROP INDEX IDX_2129058FFB88E14F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_panier AS SELECT pk, utilisateur_id, produit_id, qte FROM im2021_panier');
        $this->addSql('DROP TABLE im2021_panier');
        $this->addSql('CREATE TABLE im2021_panier --Panier de l\'utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER NOT NULL, produit_id INTEGER NOT NULL, qte INTEGER NOT NULL, CONSTRAINT FK_2129058FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES im2021_utilisateurs (pk) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2129058FF347EFB FOREIGN KEY (produit_id) REFERENCES im2021_produits (pk) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO im2021_panier (pk, utilisateur_id, produit_id, qte) SELECT pk, utilisateur_id, produit_id, qte FROM __temp__im2021_panier');
        $this->addSql('DROP TABLE __temp__im2021_panier');
        $this->addSql('CREATE INDEX IDX_2129058FF347EFB ON im2021_panier (produit_id)');
        $this->addSql('CREATE INDEX IDX_2129058FFB88E14F ON im2021_panier (utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2129058FFB88E14F');
        $this->addSql('DROP INDEX IDX_2129058FF347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_panier AS SELECT pk, utilisateur_id, produit_id, qte FROM im2021_panier');
        $this->addSql('DROP TABLE im2021_panier');
        $this->addSql('CREATE TABLE im2021_panier --Panier de l\'utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_id INTEGER NOT NULL, produit_id INTEGER NOT NULL, qte INTEGER NOT NULL)');
        $this->addSql('INSERT INTO im2021_panier (pk, utilisateur_id, produit_id, qte) SELECT pk, utilisateur_id, produit_id, qte FROM __temp__im2021_panier');
        $this->addSql('DROP TABLE __temp__im2021_panier');
        $this->addSql('CREATE INDEX IDX_2129058FFB88E14F ON im2021_panier (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_2129058FF347EFB ON im2021_panier (produit_id)');
    }
}
