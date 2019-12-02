-- 0_user.sql

-- Création de la base
CREATE DATABASE hash CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hash;

-- Création de la table des utilisateurs
CREATE TABLE user (
    id INT(3) NOT NULL AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
) ENGINE=INNODB;