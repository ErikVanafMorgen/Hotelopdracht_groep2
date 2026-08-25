<?php
$pagina_titel = 'Registratie';

$bericht = null;
$bericht_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gebruikersnaam = trim($_POST['gebruikersnaam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $wachtwoord = $_POST['wachtwoord'] ?? '';

    if ($gebruikersnaam && $email && $wachtwoord) {
        try {
            include 'includes/connectie.php';
            $check = $pdo->prepare("SELECT id FROM gebruikers WHERE gebruikersnaam = :gnaam OR email = :email LIMIT 1");
            $check->execute([':gnaam' => $gebruikersnaam, ':email' => $email]);
            if ($check->fetch()) {
                $bericht = "Gebruikersnaam of email bestaat al.";
                $bericht_type = 'fout';
            } else {
                $hash = password_hash($wachtwoord, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO gebruikers (gebruikersnaam, email, wachtwoord) VALUES (:gnaam, :email, :ww)");
                $stmt->execute([':gnaam' => $gebruikersnaam, ':email' => $email, ':ww' => $hash]);
                $bericht = "Registratie succesvol! U kunt nu inloggen.";
                $bericht_type = 'succes';
            }
        } catch (PDOException $e) {
            $bericht = "Er is een fout opgetreden. Probeer het later opnieuw.";
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
        <h2>Account Aanmaken</h2>
        <p class="auth-sub">Registreer uzelf om kamers te reserveren.</p>

        <?php if ($bericht): ?>
            <div class="bericht <?php echo $bericht_type === 'succes' ? 'bericht-succes' : 'bericht-fout'; ?>">
                <?php echo $bericht; ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="registratie.php">
            <div class="formulier-veld">
                <label for="gebruikersnaam">Gebruikersnaam</label>
                <input type="text" id="gebruikersnaam" name="gebruikersnaam" placeholder="Voer uw naam in" pattern="[A-Za-z\s]+" title="Voer alleen letters en spaties in" required>
            </div>
            <div class="formulier-veld">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
            </div>
            <div class="formulier-veld">
                <label for="wachtwoord">Wachtwoord</label>
                <input type="password" id="wachtwoord" name="wachtwoord" placeholder="Kies een sterk wachtwoord" required>
            </div>
            <button type="submit" class="btn-verstuur">Registreer</button>
        </form>
        <p class="auth-link">Heeft u al een account? <a href="login.php">Log hier in</a></p>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
