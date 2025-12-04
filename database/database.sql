CREATE DATABASE salle_sport;

USE salle_sport;

---------------------------------------
---------- Table Cours ----------------
---------------------------------------

CREATE TABLE cours(
    id_cours INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    date_cour Date NOT NULL,
    heure TIME NOT NULL,
    duree INT NOT NULL,
    max_participants INT NOT NULL DEFAULT 20
);


---------------------------------------------
---------- Table Equipements ----------------
---------------------------------------------

CREATE TABLE equipements (
    id_equipement INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    type_equipement VARCHAR(50) NOT NULL,
    quantite INT NOT NULL,
    etat VARCHAR(50) NOT NULL DEFAULT 'BON'
);

---------------------------------------------------
---------- Table cours_equipements ----------------
---------------------------------------------------

CREATE TABLE cours_equipements (
    id_cours INT,
    id_equipement INT,
    PRIMARY KEY (id_cours, id_equipement),
    FOREIGN KEY (id_cours) REFERENCES cours(id_cours) ON DELETE CASCADE,
    FOREIGN KEY (id_equipement) REFERENCES equipements(id_equipement) ON DELETE CASCADE
);

---------------------------------------
---------- Table Users ----------------
---------------------------------------

CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE,
    email VARCHAR(50) UNIQUE,
    password VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
