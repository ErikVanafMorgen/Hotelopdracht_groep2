<?php
session_start();

if (!isset($_SESSION['gebruiker_id'])) {
    header('Location: login.php');
    exit;
}

$pagina_titel = 'Reserveren';
$bericht = null;
$bericht_type = '';

include 'includes/connectie.php';

$kamer_types = $pdo->query("SELECT DISTINCT kamer_type FROM Kamer ORDER BY kamer_type")->fetchAll(PDO::FETCH_COLUMN);

if (isset($_POST['verstuur'])) {
    $kamer_type = trim($_POST['kamer_type'] ?? '');
    $start_datum = trim($_POST['start_datum'] ?? '');
    $eind_datum = trim($_POST['eind_datum'] ?? '');
    $creditcardnummer = preg_replace('/\D+/', '', $_POST['creditcardnummer'] ?? '');

    if ($kamer_type && $start_datum && $eind_datum && $creditcardnummer) {
        if ($start_datum < date('Y-m-d')) {
            $bericht = "U kunt niet in het verleden reserveren.";
            $bericht_type = 'fout';
        } elseif ($start_datum > date('Y-m-d', strtotime('+1 year'))) {
            $bericht = "U kunt maximaal 1 jaar vooruit reserveren.";
            $bericht_type = 'fout';
        } elseif ($start_datum >= $eind_datum) {
            $bericht = "De einddatum moet na de startdatum liggen.";
            $bericht_type = 'fout';
        } elseif (strlen($creditcardnummer) < 13 || strlen($creditcardnummer) > 19) {
            $bericht = "Voer een geldig creditcardnummer in.";
            $bericht_type = 'fout';
        } else {
            try {
                $stmt_kamer = $pdo->prepare("SELECT k.kamer_nummer AS kamer_id, k.kamer_nummer, k.kamer_type, k.prijs_per_nacht
                    FROM Kamer k
                    WHERE k.kamer_type = :kamer_type
                        AND k.beschikbaar = 1
                        AND NOT EXISTS (
                            SELECT 1 FROM Reserveringen r
                            WHERE r.kamer_nummer = k.kamer_nummer
                                AND NOT (r.eind_datum <= :start OR r.start_datum >= :eind)
                        )
                    ORDER BY k.kamer_nummer
                    LIMIT 1");
                $stmt_kamer->execute([
                    ':kamer_type' => $kamer_type,
                    ':start' => $start_datum,
                    ':eind' => $eind_datum
                ]);
                $kamer = $stmt_kamer->fetch(PDO::FETCH_ASSOC);

                if (!$kamer) {
                    $bericht = "Dit kamertype is helaas niet beschikbaar in de geselecteerde periode.";
                    $bericht_type = 'fout';
                } else {
                    $stmt_gebruiker = $pdo->prepare("SELECT email FROM Gebruikers WHERE id = :id");
                    $stmt_gebruiker->execute([':id' => $_SESSION['gebruiker_id']]);
                    $gebruiker = $stmt_gebruiker->fetch(PDO::FETCH_ASSOC);

                    if (!$gebruiker || !filter_var($gebruiker['email'], FILTER_VALIDATE_EMAIL)) {
                        $bericht = "Uw account heeft geen geldig e-mailadres. Pas uw accountgegevens aan en probeer opnieuw.";
                        $bericht_type = 'fout';
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO Reserveringen (email, Gebruikers_id, kamer_nummer, kamer_type, start_datum, eind_datum, creditcardnummer) VALUES (:email, :gebruiker, :kamer_nummer, :kamer_type, :start, :eind, :creditcard)");
                        $stmt->execute([
                            ':email' => $gebruiker['email'],
                            ':gebruiker' => $_SESSION['gebruiker_id'],
                            ':kamer_nummer' => $kamer['kamer_nummer'],
                            ':kamer_type' => $kamer['kamer_type'],
                            ':start' => $start_datum,
                            ':eind' => $eind_datum,
                            ':creditcard' => '**** **** **** ' . substr($creditcardnummer, -4)
                        ]);

                        $onderwerp = 'Verificatie van uw reservering - Hotel Zonne Vallei';
                        $mailbericht = "Beste gast,\n\nUw reservering is ontvangen.\n\n" .
                            "Kamer_type: {$kamer['kamer_type']}\n" .
                            "Aankomst: {$start_datum}\n" .
                            "Vertrek: {$eind_datum}\n" .
                            "Kamer_nummer: {$kamer['kamer_nummer']}\n" .
                            "Prijs per nacht: €" . number_format($kamer['prijs_per_nacht'], 2, ',', '.') . "\n\n" .
                            "Met vriendelijke groet,\nHotel Zonne Vallei";
                        $afzender = $gebruiker['email'];
                        $headers = "From: {$afzender}\r\nReply-To: {$afzender}\r\nContent-Type: text/plain; charset=UTF-8\r\n";
                        $mail_verstuurd = mail($gebruiker['email'], $onderwerp, $mailbericht, $headers);

                        $bericht = $mail_verstuurd
                            ? "Uw reservering is succesvol geplaatst. De verificatie is naar uw e-mailadres verzonden."
                            : "Uw reservering is succesvol geplaatst. De e-mail kon niet worden verzonden; controleer uw mailconfiguratie.";
                        $bericht_type = 'succes';
                    }
                }
            } catch (PDOException $e) {
                $bericht = $e->getMessage();
                $bericht_type = 'fout';
            }
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
        <h1>Reserveren</h1>
        <p>Reserveer eenvoudig uw ideale kamer bij Hotel Zonne Vallei</p>
        <div class="breadcrumb"><a href="index.php">Home</a> / Reserveren</div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Verblijf</span>
        <h2>Maak Uw Reservering</h2>
        <div class="lijn"></div>
        <p>Selecteer uw gewenste kamer en data om een reservering te plaatsen.</p>
    </div>

    <div class="reservering-layout">
        <div class="reservering-formulier">
            <h3>Uw Gegevens</h3>

            <?php if ($bericht): ?>
                <div class="bericht <?php echo $bericht_type === 'succes' ? 'bericht-succes' : 'bericht-fout'; ?>">
                    <?php echo $bericht; ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="reserverings_syteem.php">
                <div class="formulier-rij">
                    <div class="formulier-veld full">
                        <label for="kamer_type">Kamer_type</label>
                        <select id="kamer_type" name="kamer_type" required>
                            <option value="" disabled selected>Selecteer een kamertype</option>
                            <?php foreach ($kamer_types as $type): ?>
                                <option value="<?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($type, ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="formulier-rij">
                    <div class="formulier-veld">
                        <label for="start_datum">Aankomst</label>
                        <input type="date" id="start_datum" name="start_datum" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year')); ?>" required>
                    </div>
                    <div class="formulier-veld">
                        <label for="eind_datum">Vertrek</label>
                        <input type="date" id="eind_datum" name="eind_datum" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" max="<?php echo date('Y-m-d', strtotime('+1 year +1 day')); ?>" required>
                    </div>
                </div>
                <div class="formulier-rij">
                    <div class="formulier-veld full">
                        <label for="creditcardnummer">Creditcardnummer</label>
                        <input type="text" id="creditcardnummer" name="creditcardnummer" inputmode="numeric" autocomplete="cc-number" minlength="13" maxlength="23" pattern="[0-9 ]{13,23}" placeholder="1234 5678 9012 3456" required>
                    </div>
                </div>
                <button type="submit" class="btn-verstuur" name="verstuur">Reserveer Nu</button>
            </form>
        </div>

        <div class="reservering-info-kaart">
            <h3>Reserveringsinformatie</h3>

            <div class="info-item">
                <div class="info-icoon">&#9201;</div>
                <div class="info-tekst">
                    <h4>Inchecken</h4>
                    <p>Vanaf 15:00 uur</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9201;</div>
                <div class="info-tekst">
                    <h4>Uitchecken</h4>
                    <p>Tot 11:00 uur</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9993;</div>
                <div class="info-tekst">
                    <h4>Bevestiging</h4>
                    <p>U ontvangt een bevestiging via e-mail na het plaatsen van uw reservering.</p>
                </div>
            </div>

            <div class="info-item">
                <div class="info-icoon">&#9743;</div>
                <div class="info-tekst">
                    <h4>Vragen?</h4>
                    <p>Neem contact op via <a href="contact.php">het contactformulier</a> of bel +31 20 123 4567.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
