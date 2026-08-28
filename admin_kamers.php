<?php
// Deze pagina is alleen voor beheerders; requireAdmin() stuurt niet-ingelogden door naar de loginpagina.
session_start();
require_once __DIR__ . '/includes/auth.php';
requireAdmin();

$pagina_titel = 'Kamers beheren';
$bericht = null;
$bericht_type = '';
$bewerken_nummer = filter_input(INPUT_GET, 'bewerken', FILTER_VALIDATE_INT) ?: null;

include 'includes/connectie.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $actie = $_POST['actie'] ?? '';
    $kamer_type = trim($_POST['kamer_type'] ?? '');
    $prijs = filter_input(INPUT_POST, 'prijs_per_nacht', FILTER_VALIDATE_FLOAT);
    $beschikbaar = isset($_POST['beschikbaar']) ? 1 : 0;

    if ($kamer_type === '' || $prijs === false || $prijs === null || $prijs < 0) {
        $bericht = 'Vul een kamertype en een geldige prijs in.';
        $bericht_type = 'fout';
    } else {
        try {
            // Prepared statements (met :naam plaatshouders) voorkomen SQL-injectie: de database vervangt de placeholders zelf.
            if ($actie === 'toevoegen') {
                $kamer_nummer = filter_input(INPUT_POST, 'kamer_nummer', FILTER_VALIDATE_INT);
                if (!$kamer_nummer || $kamer_nummer < 1) {
                    throw new InvalidArgumentException('Vul een geldig kamernummer in.');
                }

                $stmt = $pdo->prepare('INSERT INTO Kamer (kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar) VALUES (:nummer, :type, :prijs, :beschikbaar)');
                $stmt->execute([
                    ':nummer' => $kamer_nummer,
                    ':type' => $kamer_type,
                    ':prijs' => $prijs,
                    ':beschikbaar' => $beschikbaar
                ]);
                $bericht = 'Kamer toegevoegd.';
                $bericht_type = 'succes';
            } elseif ($actie === 'bewerken') {
                $oud_kamer_nummer = filter_input(INPUT_POST, 'oud_kamer_nummer', FILTER_VALIDATE_INT);
                $kamer_nummer = filter_input(INPUT_POST, 'kamer_nummer', FILTER_VALIDATE_INT);
                if (!$oud_kamer_nummer || !$kamer_nummer || $kamer_nummer < 1) {
                    throw new InvalidArgumentException('Vul geldige kamergegevens in.');
                }

                $stmt = $pdo->prepare('UPDATE Kamer SET kamer_nummer = :nummer, kamer_type = :type, prijs_per_nacht = :prijs, beschikbaar = :beschikbaar WHERE kamer_nummer = :oud_nummer');
                $stmt->execute([
                    ':nummer' => $kamer_nummer,
                    ':type' => $kamer_type,
                    ':prijs' => $prijs,
                    ':beschikbaar' => $beschikbaar,
                    ':oud_nummer' => $oud_kamer_nummer
                ]);
                $bericht = 'Kamer aangepast.';
                $bericht_type = 'succes';
            }
        } catch (InvalidArgumentException $e) {
            $bericht = $e->getMessage();
            $bericht_type = 'fout';
        } catch (PDOException $e) {
            $bericht = 'Opslaan mislukt. Controleer of het kamernummer uniek is.';
            $bericht_type = 'fout';
        }
    }
}

$kamers = $pdo->query('SELECT kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar FROM Kamer ORDER BY kamer_nummer')->fetchAll(PDO::FETCH_ASSOC);

// Zoek de kamer op die via ?bewerken= is aangeklikt; zonder bewerken blijft het formulier leeg voor het toevoegen.
$te_bewerken = null;
foreach ($kamers as $kamer) {
    if ((int) $kamer['kamer_nummer'] === $bewerken_nummer) {
        $te_bewerken = $kamer;
        break;
    }
}

// $huidig vult het formulier met bestaande waarden bij bewerken, of met lege velden bij toevoegen.
$huidig = $te_bewerken ?? ['kamer_nummer' => '', 'kamer_type' => '', 'prijs_per_nacht' => ''];
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="pagina-banner">
    <div>
        <h1>Kamers beheren</h1>
        <p>Voeg kamers toe of pas bestaande kamers aan.</p>
        <div class="breadcrumb"><a href="index.php">Home</a> / Kamers beheren</div>
    </div>
</section>

<section class="sectie">
    <?php if ($bericht): ?>
        <div class="bericht <?php echo $bericht_type === 'succes' ? 'bericht-succes' : 'bericht-fout'; ?>">
            <?php echo htmlspecialchars($bericht, ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>

    <div class="reservering-formulier">
        <h2><?php echo $te_bewerken ? 'Kamer aanpassen' : 'Kamer toevoegen'; ?></h2>
        <form method="POST" action="admin_kamers.php<?php echo $te_bewerken ? '?bewerken=' . (int) $te_bewerken['kamer_nummer'] : ''; ?>">
            <input type="hidden" name="actie" value="<?php echo $te_bewerken ? 'bewerken' : 'toevoegen'; ?>">
            <?php if ($te_bewerken): ?><input type="hidden" name="oud_kamer_nummer" value="<?php echo (int) $te_bewerken['kamer_nummer']; ?>"><?php endif; ?>

            <div class="admin-formulier-rij">
                <div class="formulier-veld">
                    <label for="kamer_nummer">Kamernummer</label>
                    <input type="number" id="kamer_nummer" name="kamer_nummer" min="1" required <?php echo $te_bewerken ? 'readonly' : ''; ?> value="<?php echo htmlspecialchars($huidig['kamer_nummer'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="formulier-veld">
                    <label for="kamer_type">Kamertype</label>
                    <input type="text" id="kamer_type" name="kamer_type" pattern="[A-Za-z\s]+" title="Voer alleen letters en spaties in" required value="<?php echo htmlspecialchars($huidig['kamer_type'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="formulier-veld">
                    <label for="prijs_per_nacht">Prijs per nacht</label>
                    <input type="number" id="prijs_per_nacht" name="prijs_per_nacht" min="0" step="0.01" required value="<?php echo htmlspecialchars($huidig['prijs_per_nacht'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
            </div>

            <label class="admin-checkbox-rij">
                <input type="checkbox" name="beschikbaar" value="1" <?php echo (!$te_bewerken || $te_bewerken['beschikbaar']) ? 'checked' : ''; ?>>
                Beschikbaar voor reserveringen
            </label>

            <div class="admin-knoppen">
                <button type="submit" class="btn-verstuur"><?php echo $te_bewerken ? 'Wijzigingen opslaan' : 'Kamer toevoegen'; ?></button>
                <?php if ($te_bewerken): ?><a href="admin_kamers.php" class="btn-wit-goud">Annuleren</a><?php endif; ?>
            </div>
        </form>
    </div>

    <div class="admin-kamers-lijst">
        <h2>Bestaande kamers</h2>
        <div class="admin-kamer-kop">
            <span>Kamer</span>
            <span>Kamertype</span>
            <span>Prijs / nacht</span>
            <span>Status</span>
            <span>Aanpassen</span>
        </div>
        <?php foreach ($kamers as $kamer): ?>
            <div class="admin-kamer-rij">
                <span class="admin-kamer-nummer">Kamer <?php echo (int) $kamer['kamer_nummer']; ?></span>
                <span class="admin-kamer-type"><?php echo htmlspecialchars($kamer['kamer_type'], ENT_QUOTES, 'UTF-8'); ?></span>
                <!-- number_format() maakt van een getal als 109.5 een nette weergave: 109,50 -->
                <span class="admin-kamer-prijs">&euro; <?php echo number_format((float) $kamer['prijs_per_nacht'], 2, ',', '.'); ?></span>
                <span class="<?php echo $kamer['beschikbaar'] ? 'admin-status admin-status-beschikbaar' : 'admin-status admin-status-niet'; ?>">
                    <?php echo $kamer['beschikbaar'] ? 'beschikbaar' : 'niet beschikbaar'; ?>
                </span>
                <span class="btn-bewerk"><a href="admin_kamers.php?bewerken=<?php echo (int) $kamer['kamer_nummer']; ?>">Bewerken</a></span>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>