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