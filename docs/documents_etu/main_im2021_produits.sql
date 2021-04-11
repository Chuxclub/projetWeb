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