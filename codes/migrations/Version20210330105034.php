<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330105034 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2129058FFB88E14F');
        $this->addSql('DROP INDEX IDX_2129058FF347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_panier AS SELECT pk, qte FROM im2021_panier');
        $this->addSql('DROP TABLE im2021_panier');
        $this->addSql('CREATE TABLE im2021_panier --Panier de l\'utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_pk INTEGER NOT NULL, produit_pk INTEGER NOT NULL, qte INTEGER NOT NULL, CONSTRAINT FK_2129058FF03755C6 FOREIGN KEY (utilisateur_pk) REFERENCES im2021_utilisateurs (pk) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2129058F48BCA72 FOREIGN KEY (produit_pk) REFERENCES im2021_produits (pk) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO im2021_panier (pk, qte) SELECT pk, qte FROM __temp__im2021_panier');
        $this->addSql('DROP TABLE __temp__im2021_panier');
        $this->addSql('CREATE INDEX IDX_2129058FF03755C6 ON im2021_panier (utilisateur_pk)');
        $this->addSql('CREATE INDEX IDX_2129058F48BCA72 ON im2021_panier (produit_pk)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_2129058FF03755C6');
        $this->addSql('DROP INDEX IDX_2129058F48BCA72');
        $this->addSql('CREATE TEMPORARY TABLE __temp__im2021_panier AS SELECT pk, qte FROM im2021_panier');
        $this->addSql('DROP TABLE im2021_panier');
        $this->addSql('CREATE TABLE im2021_panier --Panier de l\'utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, qte INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, produit_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO im2021_panier (pk, qte) SELECT pk, qte FROM __temp__im2021_panier');
        $this->addSql('DROP TABLE __temp__im2021_panier');
        $this->addSql('CREATE INDEX IDX_2129058FFB88E14F ON im2021_panier (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_2129058FF347EFB ON im2021_panier (produit_id)');
    }
}
