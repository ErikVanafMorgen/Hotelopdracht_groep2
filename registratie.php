<?php

include 'includes/connectie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = $_POST['Gebruikersnaam'];
    $email = $_POST['email'];
    $wachtwoord = password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT);

    // Checkt of gebruikersnaam al bestaat in de database.
    $stmt = $pdo->prepare("SELECT * FROM gebruikers WHERE gebruikersnaam = :gebruikersnaam OR email = :email");
    $stmt->execute(['gebruikersnaam' => $gebruikersnaam, 'email' => $email]);
    $BestaandeGebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($BestaandeGebruiker) {
        echo "Gebruikersnaam of email bestaat al.";
    } else {
        // Voegt nieuwe gebruiker in database toe.
        $stmt = $pdo->prepare("INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (:gebruikersnaam, :email, :wachtwoord)");
        $stmt->execute(['gebruikersnaam' => $gebruikersnaam, 'email' => $email, 'wachtwoord' => $wachtwoord]);

        echo "Registratie succesvol!";
    }
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
</head>
<body>
    <h1>Registratie</h1>
    <form method="POST" action="">
        <label for="Gebruikersnaam">Gebruikersnaam:</label>
        <input type="text" id="Gebruikersnaam" name="Gebruikersnaam" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="wachtwoord">Wachtwoord:</label>
        <input type="password" id="wachtwoord" name="wachtwoord" required><br>

        <input type="submit" value="Registreer">
    </form>
</body>
</html>