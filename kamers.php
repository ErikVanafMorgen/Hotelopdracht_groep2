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
        <div class="kamer-kaart">
            <div class="kamer-afbeelding kamer-foto-1">
                <span class="kamer-prijs">Vanaf &euro;109,- /nacht</span>
            </div>
            <div class="kamer-info">
                <h3>Comfort Kamer</h3>
                <p>Onze Comfort Kamer biedt een serene ontsnapping met alle basisvoorzieningen die u nodig heeft. 
                    Geniet van een comfortabel bed, een moderne badkamer en een prachtig uitzicht op de stad. Perfect voor een kort verblijf of een zakenreis.</p>
                <div class="kamer-kenmerken">
                    <span class="kamer-kenmerk">2 Personen</span>
                    <span class="kamer-kenmerk">25 m&sup2;</span>
                    <span class="kamer-kenmerk">Wifi</span>
                    <span class="kamer-kenmerk">Airco</span>
                    <span class="kamer-kenmerk">TV</span>
                </div>
                <a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a>
            </div>
        </div>

        <div class="kamer-kaart">
            <div class="kamer-afbeelding kamer-foto-2">
                <span class="kamer-prijs">Vanaf &euro;139,- /nacht</span>
            </div>
            <div class="kamer-info">
                <h3>Deluxe Kamer</h3>
                <p>Voor degenen die net dat beetje extra comfort willen, is onze Deluxe Kamer de perfecte keuze. 
                    Deze kamers zijn ruimer en beschikken over luxere voorzieningen, zoals een zithoek en een Nespresso-apparaat. 
                    De ideale plek om te ontspannen na een dag vol ontdekkingen in Alkmaar.</p>
                <div class="kamer-kenmerken">
                    <span class="kamer-kenmerk">2 Personen</span>
                    <span class="kamer-kenmerk">35 m&sup2;</span>
                    <span class="kamer-kenmerk">Zithoek</span>
                    <span class="kamer-kenmerk">Nespresso-apparaat</span>
                    <span class="kamer-kenmerk">Badjas</span>
                </div>
                <a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a>
            </div>
        </div>

        <div class="kamer-kaart">
            <div class="kamer-afbeelding kamer-foto-3">
                <span class="kamer-prijs">Vanaf &euro;159,- /nacht</span>
            </div>
            <div class="kamer-info">
                <h3>Junior Suite</h3>
                <p>Onze Junior Suites bieden een ultieme combinatie van ruimte en luxe. 
                    Met een aparte woonkamer, een ruime badkamer en een balkon met een adembenemend uitzicht, is deze kamer perfect voor een romantisch uitje of een speciale gelegenheid.</p>
                <div class="kamer-kenmerken">
                    <span class="kamer-kenmerk">2 Personen</span>
                    <span class="kamer-kenmerk">60 m&sup2;</span>
                    <span class="kamer-kenmerk">Apparte woonkamer</span>
                    <span class="kamer-kenmerk">Balkon met mooi uitzicht</span>
                </div>
                <a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a>
            </div>
        </div>

        <div class="kamer-kaart">
            <div class="kamer-afbeelding kamer-foto-4">
                <span class="kamer-prijs">Vanaf &euro;179,- /nacht</span>
            </div>
            <div class="kamer-info">
                <h3>Familie Suite</h3>
                <p>Speciaal ontworpen voor gezinnen, biedt onze Familie Suite voldoende ruimte en comfort voor iedereen. 
                    Deze suites beschikken over twee aparte slaapkamers, een ruime woonkamer en extra voorzieningen zoals een kitchenette en speelhoek voor de kinderen. 
                    De perfecte thuisbasis voor een onvergetelijke familievakantie.</p>
                <div class="kamer-kenmerken">
                    <span class="kamer-kenmerk">4 Personen</span>
                    <span class="kamer-kenmerk">2x25 m&sup2;</span>
                    <span class="kamer-kenmerk">2 Slaapkamers</span>
                    <span class="kamer-kenmerk">Woonkamer</span>
                    <span class="kamer-kenmerk">Kitchenette</span>
                    <span class="kamer-kenmerk">Speelhoek</span>
                </div>
                <a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a>
            </div>
        </div>

        <div class="kamer-kaart">
            <div class="kamer-afbeelding kamer-foto-5">
                <span class="kamer-prijs">Vanaf &euro;199,- /nacht</span>
            </div>
            <div class="kamer-info">
                <h3>Bruidssuite</h3>
                <p>Onze Bruidssuite is de ultieme romantische ontsnapping voor pasgetrouwde stellen. 
                    Deze luxueuze suite biedt een ruime slaapkamer met een kingsize bed, een stijlvolle woonkamer en een eigen balkon met een prachtig uitzicht op Alkmaar. 
                    Geniet van extra's zoals een bubbelbad, rozenblaadjes op het bed en een fles champagne om uw speciale gelegenheid te vieren in stijl.</p>
                <div class="kamer-kenmerken">
                    <span class="kamer-kenmerk">2 Personen</span>
                    <span class="kamer-kenmerk">45 m&sup2;</span>
                    <span class="kamer-kenmerk">Kingsize Bed</span>
                    <span class="kamer-kenmerk">Balkon</span>
                    <span class="kamer-kenmerk">bubbelbad</span>
                    <span class="kamer-kenmerk">Rozenblaadjes</span>
                    <span class="kamer-kenmerk">Champagne</span>
                </div>
                <a href="reserverings_syteem.php" class="btn-kamer">Reserveer Nu</a>
            </div>
        </div>
    </div>
</section>

<section class="sectie sectie-wit-klein">
    <div class="reservering-banner container-1200">
        <h3>Niet Zeker Welke Kamer?</h3>
        <p>Neem contact met ons op en wij helpen u de perfecte kamer te vinden voor uw verblijf.</p>
        <a href="contact.php" class="btn-wit">Neem Contact Op</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
