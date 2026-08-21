CREATE DATABASE IF NOT EXISTS Zonne_vallei;

USE Zonne_vallei;

CREATE TABLE IF NOT EXISTS gebruikers (
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

INSERT IGNORE INTO Kamer (id, kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar) VALUES
(1, 101, 'Standaard Kamer', 89.00, 1),
(2, 102, 'Standaard Kamer', 89.00, 1),
(3, 103, 'Standaard Kamer', 89.00, 1),
(4, 201, 'Luxe Kamer', 139.00, 1),
(5, 202, 'Luxe Kamer', 139.00, 1),
(6, 203, 'Luxe Kamer', 139.00, 1),
(7, 301, 'President Suite', 199.00, 1),
(8, 302, 'President Suite', 199.00, 1),
(9, 401, 'Familie Kamer', 109.00, 1),
(10, 402, 'Familie Kamer', 109.00, 1),
(11, 403, 'Familie Kamer', 109.00, 1),
(12, 501, 'Business Suite', 169.00, 1),
(13, 502, 'Business Suite', 169.00, 1),
(14, 601, 'Romantische Suite', 249.00, 1),
(15, 602, 'Romantische Suite', 249.00, 1);

CREATE TABLE IF NOT EXISTS Reserveringen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Gebruikers_id INT NOT NULL,
    kamer_id INT NOT NULL,
    kamer_type VARCHAR(50) NOT NULL,
    start_datum DATE NOT NULL,
    eind_datum DATE NOT NULL,
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