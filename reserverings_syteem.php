<?php

session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

include 'includes/connectie.php';

?>

<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserveringssysteem</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <main>
        <h1>Reserveringssysteem</h1>
        <p>Welkom bij ons reserveringssysteem!</p>
    </main>

    <form method="POST" action="reserverings_syteem.php">
        <label for="kamer_type">Kamer Type:</label>
        <select id="kamer_type" name="kamer_type" required>
            <option value="">Selecteer een kamer type</option>
            <option value="C Kamer">Comfort Kamer</option>
            <option value="D Kamer">Deluxe Kamer</option>
            <option value="J Suite">Junior Suite</option>
            <option value="F Suite">Familie Suite</option>
            <option value="B Suite">Bruidssuite</option>
        </select>

        <label for="start_datum">Start Datum:</label>
        <input type="date" id="start_datum" name="start_datum" required>

        <label for="eind_datum">Eind Datum:</label>
        <input type="date" id="eind_datum" name="eind_datum" required>

        <button type="submit">Reserveer</button>
    </form>

    <?php include 'includes/footer.php'; ?>
    
</body>

