<?php
$pagina_titel = 'contact';
$bericht = null;
$bericht_type = '';

if (isset($_POST['verstuur'])) {
    $naam = trim($_POST['naam'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $telefoon = trim($_POST['telefoon'] ?? '');
    $onderwerp = trim($_POST['onderwerp'] ?? '');
    $bericht_tekst = trim($_POST['bericht'] ?? '');

    // Controleer of alle verplichte velden zijn ingevuld
    if ($naam && $email && $onderwerp && $bericht_tekst) {
        try {
            include 'includes/connectie.php';
            $stmt = $pdo->prepare("INSERT INTO contact (Gebruikers_id, onderwerp, bericht) VALUES (NULL, :onderwerp, :bericht)");
            $stmt->execute([':onderwerp' => $onderwerp, ':bericht' => "Van: $naam ($email, $telefoon)\n\n$bericht_tekst"]);
            $bericht = "Bedankt voor uw bericht! Wij nemen zo snel mogelijk contact met u op.";
            $bericht_type = 'succes';
        } catch (PDOException $e) {
            $bericht = "Er is iets misgegaan. Probeer het opnieuw of neem telefonisch contact op.";
            $bericht_type = 'fout';
        }
    } else {
        $bericht = "Vul alle verplichte velden in.";
        $bericht_type = 'fout';
    }
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="pagina-banner">
    <div>
        <h1>Contact</h1>
        <p>Heeft u vragen of wilt u meer informatie? Wij helpen u graag verder.</p>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Neem Contact Op</span>
        <h2>Wij Zijn Er Voor U</h2>
        <div class="lijn"></div>
    </div>

    <div class="contact-layout">
        <div class="contact-info-kaart">
            <h3>Contactgegevens</h3>

            <div class="info-item">
                <div class="info-icoon">&#9900;</div>
                <div class="info-tekst">
                    <h4>Adres</h4>
                    <p>Zonnevalleiweg 42<br>1234 AB Zonnevallei</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9743;</div>
                <div class="info-tekst">
                    <h4>Telefoon</h4>
                    <p>+31 20 123 4567<br>Ma - Zo: 08:00 - 20:00</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9993;</div>
                <div class="info-tekst">
                    <h4>E-mail</h4>
                    <p>info@zonnevallei.nl<br>reserveringen@zonnevallei.nl</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9201;</div>
                <div class="info-tekst">
                    <h4>Receptie</h4>
                    <p>24 uur geopend<br>7 dagen per week</p>
                </div>
            </div>
        </div>

        <div class="contact-formulier">
            <h3>Stuur Ons Een Bericht</h3>

            <?php if ($bericht): ?>
                <div class="bericht <?php echo $bericht_type === 'succes' ? 'bericht-succes' : 'bericht-fout'; ?>">
                    <?php echo $bericht; ?>
                </div>
            <?php endif; ?>

            // Het contactformulier met velden voor naam, e-mail, telefoon, onderwerp en bericht. Met validatie voor e-mail en telefoonnummer.

            <form method="POST" action="contact.php" id="ContactForm">
                <div class="formulier-rij">
                    <div class="formulier-veld">
                        <label for="naam">Naam</label>
                        <input type="text" id="naam" name="naam" placeholder="Uw volledige naam" pattern="[A-Za-z\s]+" title="Voer alleen letters en spaties in" required>
                    </div>
                    <div class="formulier-veld">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" name="email" placeholder="uw@email.nl" required>
                    </div>
                </div>
                <div class="formulier-rij">
                    <div class="formulier-veld">
                        <label for="telefoon">Telefoon</label>
                        <input type="tel" id="telefoon" name="telefoon" placeholder="+31 6 12345678" pattern="^\+?[0-9\s\-()]{7,20}$" title="Voer een geldig telefoonnummer in" required>
                    </div>
                    <div class="formulier-veld">
                        <label for="onderwerp">Onderwerp</label>
                        <select id="onderwerp" name="onderwerp" required>
                            <option value="" disabled selected>Kies een onderwerp</option>
                            <option value="Algemene vraag">Algemene vraag</option>
                            <option value="Annuleren">Annuleren</option>
                            <option value="Klacht">Klacht</option>
                            <option value="Reservering">Reservering</option>
                            <option value="Restaurant">Restaurant</option>
                            <option value="Technisch probleem">Technisch probleem</option>
                        </select>
                    </div>
                </div>
                <div class="formulier-rij">
                    <div class="formulier-veld full">
                        <label for="bericht">Berichten</label>
                        <textarea id="bericht" name="bericht" placeholder="Typ hier uw bericht..." required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn-verstuur" name="verstuur">Verstuur Bericht</button>
            </form>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>