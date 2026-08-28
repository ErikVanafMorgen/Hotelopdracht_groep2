<?php

/** Maakt de databaseverbinding met de database. */
try {
    $pdo = new PDO('mysql:host=localhost;dbname=Zonne_vallei', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Databaseverbinding mislukt.');
}