<?php
$pagina_titel = 'Kamers';
include 'includes/connectie.php';
$kamers = $pdo->query('SELECT kamer_nummer, kamer_type, prijs_per_nacht, beschikbaar FROM Kamer ORDER BY kamer_nummer')->fetchAll(PDO::FETCH_ASSOC);
$kamer_afbeeldingen = [
    'Comfort Kamer' => 'https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80',
    'Deluxe Kamer' => 'https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80',
    'Junior Suite' => 'https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=600&q=80',
    'Familie Suite' => 'https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80',
    'Bruidsuite' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=600&q=80'
];
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="pagina-banner">
    <div>
        <h1>Ontdek onze Kamers</h1>
        <p>Welkom in het 3-duimen Hotel De Zonne Vallei, waar luxe en comfort hand in hand gaan. Gelegen in het hart van Alkmaar, bieden onze kamers een perfecte balans tussen modern design en gezelligheid. 
            Of u nu voor een romantisch uitje, een familievakantie of een zakelijke bijeenkomst komt, ons hotel heeft precies wat u nodig heeft voor een onvergetelijk verblijf.
            Geniet van de rust en elegantie van onze kamers en ervaar de uitzonderlijke gastvrijheid die ons hotel kenmerkt.</p>
        <div class="breadcrumb"><a href="index.php">Home</a> / Kamers</div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Verblijf</span>
        <h2>Kamertypen & Prijzen</h2>
        <div class="lijn"></div>
        <p>Van comfortabele standaard kamers tot luxueuze suites, wij hebben de perfecte kamer voor uw verblijf.</p>
    </div>

    <div class="kamers-grid">
        <?php foreach ($kamers as $kamer): ?>
            <div class="kamer-kaart">
                <div class="kamer-afbeelding" style="background-image: url('<?php echo htmlspecialchars($kamer_afbeeldingen[$kamer['kamer_type']] ?? $kamer_afbeeldingen['Comfort Kamer'], ENT_QUOTES, 'UTF-8'); ?>')">
                    <span class="kamer-prijs">&euro;<?php echo number_format((float) $kamer['prijs_per_nacht'], 2, ',', '.'); ?> /nacht</span>
                </div>
                <div class="kamer-info">
                    <h3><?php echo htmlspecialchars($kamer['kamer_type'], ENT_QUOTES, 'UTF-8'); ?> #<?php echo (int) $kamer['kamer_nummer']; ?></h3>
                    <p>Een comfortabele kamer bij Hotel Zonne Vallei, ingericht voor een aangenaam verblijf.</p>
                    <div class="kamer-kenmerken">
                        <span class="kamer-kenmerk"><?php echo $kamer['beschikbaar'] ? 'Beschikbaar' : 'Niet beschikbaar'; ?></span>
                    </div>
                    <?php if ($kamer['beschikbaar']): ?><a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a><?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="sectie" style="background: var(--wit); padding: 80px 40px; max-width: none;">
    <div class="reservering-banner" style="max-width: 1200px; margin: 0 auto;">
        <h3>Niet Zeker Welke Kamer?</h3>
        <p>Neem contact met ons op en wij helpen u de perfecte kamer te vinden voor uw verblijf.</p>
        <a href="contact.php" class="btn-wit">Neem Contact Op</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
