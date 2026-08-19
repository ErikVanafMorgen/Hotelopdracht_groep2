CREATE DATABASE IF NOT EXISTS Zonne_vallei;

USE Zonne_vallei;

CREATE TABLE IF NOT EXISTS gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    wachtwoord VARCHAR(255) NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Reserveringen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Gebruikers_id INT NOT NULL,
    kamer_id INT NOT NULL AUTO_INCREMENT,
    kamer_type VARCHAR(50) NOT NULL,
    start_datum DATE NOT NULL,
    eind_datum DATE NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id),
    FOREIGN KEY (kamer_id) REFERENCES Kamer(id)
);

CREATE TABLE IF NOT EXISTS Restaurant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    naam VARCHAR(100) NOT NULL,
    locatie VARCHAR(255) NOT NULL,
    openingstijden VARCHAR(100) NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Gebruikers_id INT,
    onderwerp VARCHAR(100) NOT NULL,
    bericht TEXT NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id)
);