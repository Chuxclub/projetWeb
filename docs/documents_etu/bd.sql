create table doctrine_migration_versions
(
    version        VARCHAR(191) not null
        primary key,
    executed_at    DATETIME default NULL,
    execution_time INTEGER  default NULL
);

INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES ('DoctrineMigrations\Version20210330093836', '2021-03-30 11:40:00', 60);
INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES ('DoctrineMigrations\Version20210330094836', '2021-03-30 11:48:48', 9);
INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES ('DoctrineMigrations\Version20210330103614', '2021-03-30 12:36:21', 10);
INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES ('DoctrineMigrations\Version20210330104417', '2021-03-30 12:44:49', 11);
INSERT INTO doctrine_migration_versions (version, executed_at, execution_time) VALUES ('DoctrineMigrations\Version20210330105034', '2021-03-30 12:50:37', 10);

create table im2021_panier
(
    pk             INTEGER not null
        primary key autoincrement,
    utilisateur_pk INTEGER not null
        constraint FK_2129058FF03755C6
            references im2021_utilisateurs,
    produit_pk     INTEGER not null
        constraint FK_2129058F48BCA72
            references im2021_produits,
    qte            INTEGER not null
);

create index IDX_2129058F48BCA72
    on im2021_panier (produit_pk);

create index IDX_2129058FF03755C6
    on im2021_panier (utilisateur_pk);

INSERT INTO im2021_panier (pk, utilisateur_pk, produit_pk, qte) VALUES (12, 8, 2, 1);
INSERT INTO im2021_panier (pk, utilisateur_pk, produit_pk, qte) VALUES (13, 8, 5, 3);

create table im2021_produits
(
    pk            INTEGER      not null
        primary key autoincrement,
    libelle       VARCHAR(100) not null,
    prix_unitaire INTEGER      not null,
    qte           INTEGER      not null
);

create unique index UNIQ_2A6755E0A4D60759
    on im2021_produits (libelle);

INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (1, 'Life Is Strange', 15, 10);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (2, 'Zelda Twilight Princess', 25, 3);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (3, 'Animal Crossing New Horizon', 60, 100);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (4, 'Mass Effect', 18, 8000);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (5, 'Portal 2', 8, 18);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (6, 'Kerbal Space Program', 25, 15);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (7, 'Minecraft', 20, 50);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (8, 'Zelda Majora''s Mask', 32, 1);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (9, 'Sonic', 15, 1);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (10, 'Pong', 2, 120);
INSERT INTO im2021_produits (pk, libelle, prix_unitaire, qte) VALUES (11, 'Tetris', 5, 14);

create table im2021_utilisateurs
(
    pk       INTEGER     not null
        primary key autoincrement,
    login    VARCHAR(30) not null,
    mdp      VARCHAR(64) not null,
    nom      VARCHAR(30) default NULL,
    prenom   VARCHAR(30) default NULL,
    date_n   DATE        default NULL,
    is_admin BOOLEAN     default '0' not null
);

create unique index UNIQ_29DD1761AA08CB10
    on im2021_utilisateurs (login);

INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (1, 'admin', 'a4cbb2f3933c5016da7e83fd135ab8a48b67bf61', 'admin', 'admin', '1970-07-01', 1);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (3, 'gilles', 'ab9240da95937a0d51b41773eafc8ccb8e7d58b5', 'subrenat', 'gilles', '1970-01-01', 0);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (4, 'rita', '1811ed39aa69fa4da3c457bdf096c1f10cf81a9b', 'zrour', 'rita', '1980-01-01', 0);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (5, 'chuxclub', 'ee123eb02eec37f53220855b6c97549b00beb170', 'legendre', 'florian', '1992-08-20', 0);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (6, 'iron_man', '7b5f217b3299e36c2b3528d6838a8aeeb4e292e0', 'fradet', 'amandine', '1995-09-26', 0);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (7, 'darkRider86', '0529b1363f61b58aa828cfbd2d4af24be5547cb0', null, null, '2008-07-25', 0);
INSERT INTO im2021_utilisateurs (pk, login, mdp, nom, prenom, date_n, is_admin) VALUES (15, 'dummy', '5a4125203709642076bdb2c985f5e91a66d2f750', null, null, '2021-03-31', 0);

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

create table sqlite_sequence
(
    name,
    seq
);

INSERT INTO sqlite_sequence (name, seq) VALUES ('im2021_panier', 20);
INSERT INTO sqlite_sequence (name, seq) VALUES ('im2021_utilisateurs', 18);
INSERT INTO sqlite_sequence (name, seq) VALUES ('im2021_produits', 11);
