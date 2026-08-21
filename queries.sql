CREATE DATABASE IF NOT EXISTS Zonne_vallei;

USE Zonne_vallei;

CREATE TABLE IF NOT EXISTS Gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    wachtwoord VARCHAR(255) NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Kamer (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kamer_nummer INT NOT NULL UNIQUE,
    kamer_type VARCHAR(50) NOT NULL,
    prijs_per_nacht DECIMAL(10,2) NOT NULL,
    beschikbaar BOOLEAN DEFAULT TRUE,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT IGNORE INTO Kamer
    (kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar)
VALUES
    (1, 'Comfort Kamer', 109.00, TRUE),
    (2, 'Deluxe Kamer', 139.00, TRUE),
    (3, 'Familie Suite', 179.00, TRUE),
    (4, 'Junior Suite', 159.00, TRUE),
    (5, 'Familie Suite', 179.00, TRUE),
    (6, 'Bruidsuite', 199.00, TRUE);

CREATE TABLE IF NOT EXISTS Reserveringen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL,
    Gebruikers_id INT NOT NULL,
    kamer_id INT NOT NULL,
    kamer_type VARCHAR(50) NOT NULL,
    start_datum DATE NOT NULL,
    eind_datum DATE NOT NULL,
    creditcardnummer VARCHAR(23) NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id),
    FOREIGN KEY (kamer_id) REFERENCES Kamer(id)
);

CREATE TABLE IF NOT EXISTS Contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Gebruikers_id INT,
    onderwerp VARCHAR(100) NOT NULL,
    bericht TEXT NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id)
);