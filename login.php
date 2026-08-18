<?php

include 'includes/connectie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $email = $_POST['email'];
    $wachtwoord = $_POST['wachtwoord'];

    // Haalt de gebruiker op uit de database.
    $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam OR email = :email");
    $stmt->execute(['gebruikersnaam' => $gebruikersnaam, 'email' => $email]);
    $Gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    // Checkt op of de gebruikersnaam en of het wachtwoord correct is.
    if ($Gebruiker && password_verify($wachtwoord, $Gebruiker['wachtwoord'])) {
        echo "Inloggen succesvol!";
    } else {
        echo "Ongeldige gebruikersnaam/email of wachtwoord.";
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        <label for="Gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" id="Gebruikersnaam" name="Gebruikersnaam" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br>

        <input type="submit" value="Inloggen">
    </form>
</body>
</html>