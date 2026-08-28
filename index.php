<?php $pagina_titel = 'Home'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="hero">
    <div class="hero-content">
        <img src="images/logo_OG.png" alt="Zonne Vallei" class="hero-logo">
        <h1>Welkom bij Hotel De Zonne Vallei</h1>
        <p>Ontsnap aan de dagelijkse drukte en ontdek de rust en luxe van Hotel De Zonne Vallei, een 3-duimen hotel gelegen in het hart van Alkmaar. 
            Ons hotel biedt een perfecte mix van comfort, gastvrijheid en adembenemende natuur. 
            Of u nu voor een romantisch uitje, een familievakantie of een zakelijke bijeenkomst komt, ons hotel heeft precies wat u nodig heeft voor een onvergetelijk verblijf.</p>
        <div class="hero-buttons">
            <a href="kamers.php" class="btn-primary">Bekijk Kamers</a>
            <a href="contact.php" class="btn-secondary">Neem Contact Op</a>
        </div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Waarom Zonne Vallei</span>
        <h2>Een Unieke Ervaring</h2>
        <div class="lijn"></div>
    </div>
    <div class="voordelen-grid">
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9734;</div>
            <h3>Ontdek onze kamers</h3>
            <p>Of u nu op zoek bent naar een romantisch uitje, een familievakantie of een zakelijke bijeenkomst, onze stijlvolle en goed uitgeruste kamers bieden alles wat u nodig heeft voor een onvergetelijk verblijf.
                Geniet van moderne voorzieningen, comfortabele bedden en een prachtig uitzicht op de omgeving.</p>
        </div>
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9829;</div>
            <h3>Culinaire Verwennerij</h3>
            <p>Laat uw smaakpapillen prikkelen in ons restaurant, waar onze chef-kok met passie lokale ingrediënten omtovert tot culinaire meesterwerken. 
                Van een uitgebreid ontbijt tot een intiem diner, elke maaltijd is een ervaring op zich. Ontdek ons menu en geniet van de smaken van Alkmaar.</p>
        </div>
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9788;</div>
            <h3>Ontdek de Omgeving</h3>
            <p>Hotel De Zonne Vallei ligt in het bruisende hart van Alkmaar, een stad die rijk is aan geschiedenis en cultuur. 
                Verken de pittoreske straatjes, bewonder de eeuwenoude architectuur en bezoek de wereldberoemde kaasmarkt. 
                Of u nu winkelt in de boetiekjes, geniet van een drankje op een van de vele terrassen of een ontspannen wandeling maakt langs de grachten, Alkmaar biedt voor ieder wat wils. 
                Ontdek de schoonheid en charme van deze historische stad tijdens uw verblijf in ons hotel.</p>
        </div>
    </div>
</section>

<section class="sectie" style="background: var(--wit); padding: 100px 40px; max-width: none;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <div class="sectie-kop">
            <span class="ondertitel">Onze Kamers</span>
            <h2>Comfort & Luxe</h2>
            <div class="lijn"></div>
            <p>Ontdek ons aanbod van zorgvuldig ingerichte kamers die voldoen aan al uw wensen.</p>
        </div>
        <div class="kamers-grid">
            <div class="kamer-kaart">
                <div class="kamer-afbeelding" style="background-image: url('https://images.unsplash.com/photo-1611892440504-42a792e24d32?w=600&q=80')">
                    <span class="kamer-prijs">Vanaf &euro;89,- /nacht</span>
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
                <div class="kamer-afbeelding" style="background-image: url('https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80')">
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
                <div class="kamer-afbeelding" style="background-image: url('https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600&q=80')">
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
        </div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Ons Restaurant</span>
        <h2>Culinaire Verwennerij</h2>
        <div class="lijn"></div>
    </div>
    <div class="restaurant-content">
        <div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--goud); margin-bottom: 20px;">Ontbijt, Lunch & Diner</h3>
            <p style="color: var(--tekst); line-height: 1.8; margin-bottom: 15px;">Verse ingrediënten, lokale producten en pure passie — dat proeft u in elke hap. Onze chef-kok creëert dagelijks gerechten die verrassen.</p>
            <p style="color: var(--tekst-licht); line-height: 1.8; margin-bottom: 25px;">Van een rustig ontbijt tot een verfijnd driegangendiner. Ons menu wisselt met de seizoenen, zodat er altijd iets nieuws op u wacht.</p>
            <a href="restaurant.php" class="btn-primary">Bekijk Ons Menu</a>
        </div>
        <div class="openingstijden">
            <h3>Openingstijden Restaurant</h3>
            <div class="uren-rij"><span class="dag">Maandag - Vrijdag</span><span class="tijd">07:00 - 22:00</span></div>
            <div class="uren-rij"><span class="dag">Zaterdag</span><span class="tijd">08:00 - 23:00</span></div>
            <div class="uren-rij"><span class="dag">Zondag</span><span class="tijd">08:00 - 21:00</span></div>
        </div>
    </div>
</section>

<section class="sectie" style="background: var(--wit); padding: 80px 40px; max-width: none;">
    <div class="reservering-banner" style="max-width: 1200px; margin: 0 auto;">
        <h3>Plan Uw Verblijf</h3>
        <p>Reserveer nu uw kamer en geniet van een onvergetelijke ervaring bij Hotel Zonne Valei.</p>
        <a href="reserverings_syteem.php" class="btn-wit">Reserveer Nu</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
