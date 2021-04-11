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