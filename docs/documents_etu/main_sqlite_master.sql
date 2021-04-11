create table sqlite_master
(
    type     text,
    name     text,
    tbl_name text,
    rootpage int,
    sql      text
);

INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('table', 'doctrine_migration_versions', 'doctrine_migration_versions', 2, 'CREATE TABLE doctrine_migration_versions (version VARCHAR(191) NOT NULL, executed_at DATETIME DEFAULT NULL, execution_time INTEGER DEFAULT NULL, PRIMARY KEY(version))');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('index', 'sqlite_autoindex_doctrine_migration_versions_1', 'doctrine_migration_versions', 3, null);
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('table', 'im2021_utilisateurs', 'im2021_utilisateurs', 4, 'CREATE TABLE im2021_utilisateurs --Table des utilisateurs du site
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, login VARCHAR(30) NOT NULL --sert de login (doit être unique)
        , mdp VARCHAR(64) NOT NULL --mot de passe crypté : il faut une taille assez grande pour ne pas le tronquer
        , nom VARCHAR(30) DEFAULT NULL, prenom VARCHAR(30) DEFAULT NULL, date_n DATE DEFAULT NULL, is_admin BOOLEAN DEFAULT ''0'' NOT NULL --type booléen
        )');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('table', 'sqlite_sequence', 'sqlite_sequence', 5, 'CREATE TABLE sqlite_sequence(name,seq)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('index', 'UNIQ_29DD1761AA08CB10', 'im2021_utilisateurs', 6, 'CREATE UNIQUE INDEX UNIQ_29DD1761AA08CB10 ON im2021_utilisateurs (login)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('table', 'im2021_produits', 'im2021_produits', 7, 'CREATE TABLE im2021_produits --Table des produits de la boutique
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, libelle VARCHAR(100) NOT NULL, prix_unitaire INTEGER NOT NULL, qte INTEGER NOT NULL)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('index', 'UNIQ_2A6755E0A4D60759', 'im2021_produits', 8, 'CREATE UNIQUE INDEX UNIQ_2A6755E0A4D60759 ON im2021_produits (libelle)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('table', 'im2021_panier', 'im2021_panier', 9, 'CREATE TABLE im2021_panier --Panier de l''utilisateur (jointure entre utilisateurs et produits)
        (pk INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, utilisateur_pk INTEGER NOT NULL, produit_pk INTEGER NOT NULL, qte INTEGER NOT NULL, CONSTRAINT FK_2129058FF03755C6 FOREIGN KEY (utilisateur_pk) REFERENCES im2021_utilisateurs (pk) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2129058F48BCA72 FOREIGN KEY (produit_pk) REFERENCES im2021_produits (pk) NOT DEFERRABLE INITIALLY IMMEDIATE)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('index', 'IDX_2129058FF03755C6', 'im2021_panier', 10, 'CREATE INDEX IDX_2129058FF03755C6 ON im2021_panier (utilisateur_pk)');
INSERT INTO sqlite_master (type, name, tbl_name, rootpage, sql) VALUES ('index', 'IDX_2129058F48BCA72', 'im2021_panier', 11, 'CREATE INDEX IDX_2129058F48BCA72 ON im2021_panier (produit_pk)');