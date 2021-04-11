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