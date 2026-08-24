CREATE DATABASE IF NOT EXISTS Zonne_vallei;

USE Zonne_vallei;

CREATE TABLE IF NOT EXISTS Gebruikers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gebruikersnaam VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    wachtwoord VARCHAR(255) NOT NULL,
    is_admin BOOLEAN NOT NULL DEFAULT FALSE,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS Kamer (
    kamer_nummer INT AUTO_INCREMENT PRIMARY KEY,
    kamer_type VARCHAR(50) NOT NULL,
    prijs_per_nacht DECIMAL(10,2) NOT NULL,
    beschikbaar BOOLEAN DEFAULT TRUE,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

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
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id)
);

-- Migratie voor databases die vóór kamer_nummer als sleutel zijn aangemaakt.
ALTER TABLE Gebruikers ADD COLUMN IF NOT EXISTS is_admin BOOLEAN NOT NULL DEFAULT FALSE;
ALTER TABLE Kamer ADD COLUMN IF NOT EXISTS kamer_nummer INT NULL;
SET @kamer_id_bestaat = (SELECT COUNT(*) FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = DATABASE() AND TABLE_NAME = 'Kamer' AND COLUMN_NAME = 'id');
SET @sql = IF(@kamer_id_bestaat > 0, 'UPDATE Kamer SET kamer_nummer = id WHERE kamer_nummer IS NULL', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @sql = IF(@kamer_id_bestaat > 0, 'UPDATE Reserveringen r INNER JOIN Kamer k ON r.kamer_id = k.id SET r.kamer_id = k.kamer_nummer', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @sql = IF(@kamer_id_bestaat > 0, 'ALTER TABLE Reserveringen DROP FOREIGN KEY Reserveringen_ibfk_2', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @sql = IF(@kamer_id_bestaat > 0, 'ALTER TABLE Kamer DROP PRIMARY KEY', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @sql = IF(@kamer_id_bestaat > 0, 'ALTER TABLE Kamer DROP COLUMN id', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @sql = IF(@kamer_id_bestaat > 0, 'ALTER TABLE Kamer MODIFY kamer_nummer INT NOT NULL, ADD PRIMARY KEY (kamer_nummer)', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;
SET @kamer_fk_bestaat = (SELECT COUNT(*) FROM information_schema.REFERENTIAL_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = 'Reserveringen' AND CONSTRAINT_NAME = 'reserveringen_kamer_fk');
SET @sql = IF(@kamer_fk_bestaat = 0, 'ALTER TABLE Reserveringen ADD CONSTRAINT reserveringen_kamer_fk FOREIGN KEY (kamer_id) REFERENCES Kamer(kamer_nummer)', 'SELECT 1');
PREPARE statement FROM @sql;
EXECUTE statement;
DEALLOCATE PREPARE statement;

INSERT IGNORE INTO Kamer
    (kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar)
VALUES
    (1, 'Comfort Kamer', 109.00, TRUE),
    (2, 'Deluxe Kamer', 139.00, TRUE),
    (3, 'Familie Suite', 179.00, TRUE),
    (4, 'Junior Suite', 159.00, TRUE),
    (5, 'Familie Suite', 179.00, TRUE),
    (6, 'Bruidsuite', 199.00, TRUE);

CREATE TABLE IF NOT EXISTS Contact (
    id INT AUTO_INCREMENT PRIMARY KEY,
    Gebruikers_id INT,
    onderwerp VARCHAR(100) NOT NULL,
    bericht TEXT NOT NULL,
    aangemaakt_op TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Gebruikers_id) REFERENCES Gebruikers(id)
);