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

$kamers = $pdo->query("SELECT id, kamer_type, kamer_nummer, prijs_per_nacht FROM Kamer WHERE beschikbaar = 1 ORDER BY kamer_type, kamer_nummer")->fetchAll(PDO::FETCH_ASSOC);

if (isset($_POST['verstuur'])) {
    $kamer_id = intval($_POST['kamer_id'] ?? 0);
    $start_datum = trim($_POST['start_datum'] ?? '');
    $eind_datum = trim($_POST['eind_datum'] ?? '');

    if ($kamer_id && $start_datum && $eind_datum) {
        if ($start_datum < date('Y-m-d')) {
            $bericht = "U kunt niet in het verleden reserveren.";
            $bericht_type = 'fout';
        } elseif ($start_datum > date('Y-m-d', strtotime('+1 year'))) {
            $bericht = "U kunt maximaal 1 jaar vooruit reserveren.";
            $bericht_type = 'fout';
        } elseif ($start_datum >= $eind_datum) {
            $bericht = "De einddatum moet na de startdatum liggen.";
            $bericht_type = 'fout';
        } else {
            try {
                $stmt_kamer = $pdo->prepare("SELECT id, kamer_type FROM Kamer WHERE id = :id");
                $stmt_kamer->execute([':id' => $kamer_id]);
                $kamer = $stmt_kamer->fetch(PDO::FETCH_ASSOC);

                if (!$kamer) {
                    $bericht = "De geselecteerde kamer bestaat niet.";
                    $bericht_type = 'fout';
                } else {
                    $check = $pdo->prepare("SELECT COUNT(*) FROM Reserveringen WHERE kamer_id = :kamer_id AND NOT (eind_datum <= :start OR start_datum >= :eind)");
                    $check->execute([':kamer_id' => $kamer_id, ':start' => $start_datum, ':eind' => $eind_datum]);

                    if ($check->fetchColumn() > 0) {
                        $bericht = "Deze kamer is helaas niet beschikbaar in de geselecteerde periode. Kies een andere datum of kamer.";
                        $bericht_type = 'fout';
                    } else {
                        $stmt = $pdo->prepare("INSERT INTO Reserveringen (Gebruikers_id, kamer_id, kamer_type, start_datum, eind_datum) VALUES (:gebruiker, :kamer_id, :kamer_type, :start, :eind)");
                        $stmt->execute([
                            ':gebruiker' => $_SESSION['gebruiker_id'],
                            ':kamer_id' => $kamer_id,
                            ':kamer_type' => $kamer['kamer_type'],
                            ':start' => $start_datum,
                            ':eind' => $eind_datum
                        ]);
                        $bericht = "Uw reservering is succesvol geplaatst! Wij zien u graag verschijnen.";
                        $bericht_type = 'succes';
                    }
                }
            } catch (PDOException $e) {
                $bericht = "Er is iets misgegaan. Probeer het opnieuw.";
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
                        <label for="kamer_id">Kamer</label>
                        <select id="kamer_id" name="kamer_id" required>
                            <option value="" disabled selected>Selecteer een kamer</option>
                            <?php foreach ($kamers as $k): ?>
                                <option value="<?php echo $k['id']; ?>"><?php echo htmlspecialchars($k['kamer_type'] . ' — Kamer ' . $k['kamer_nummer'] . ' (€' . number_format($k['prijs_per_nacht'], 2, ',', '.') . '/nacht)'); ?></option>
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
