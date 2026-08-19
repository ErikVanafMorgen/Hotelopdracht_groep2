<?php
session_start();
$pagina_titel = 'Inloggen';

$bericht = null;
$bericht_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if ($gebruikersnaam && $email && $wachtwoord) {
        try {
            include 'includes/connectie.php';
            $stmt = $pdo->prepare("SELECT * FROM Gebruikers WHERE gebruikersnaam = :gnaam OR email = :email LIMIT 1");
            $stmt->execute([':gnaam' => $gebruikersnaam, ':email' => $email]);
            $gebruiker = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($gebruiker && password_verify($wachtwoord, $gebruiker['wachtwoord'])) {
                $_SESSION['gebruiker_id'] = $gebruiker['id'];
                $_SESSION['gebruikersnaam'] = $gebruiker['gebruikersnaam'];
                header('Location: index.php');
                exit;
            } else {
                $bericht = "Ongeldige gebruikersnaam/email of wachtwoord.";
                $bericht_type = 'fout';
            }
        } catch (PDOException $e) {
            $bericht = "Er is een fout opgetreden. Probeer het opnieuw.";
            $bericht_type = 'fout';
        }
    } else {
        $bericht = "Vul alle velden in.";
        $bericht_type = 'fout';
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="auth-sectie">
    <div class="auth-kaart">
        <h2>Welkom Terug</h2>
        <p class="auth-sub">Log in op uw account om verder te gaan</p>

        <?php if ($bericht): ?>
            <div class="bericht <?php echo $bericht_type === 'succes' ? 'bericht-succes' : 'bericht-fout'; ?>">
                <?php echo $bericht; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="formulier-veld">
                <label for="gebruikersnaam">Gebruikersnaam</label>
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" placeholder="Voer uw gebruikersnaam in" required>
            </div>
            <div class="formulier-veld">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
            </div>
            <div class="formulier-veld">
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Voer uw wachtwoord in" required>
            </div>
            <button type="submit" class="btn-verstuur">Inloggen</button>
        </form>
        <p class="auth-link">Nog geen account? <a href="registratie.php">Registreer hier</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
