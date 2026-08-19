<?php $pagina_titel = 'Home'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="hero">
    <div class="hero-content">
        <p class="hero-subtitle">Welkom bij</p>
        <h1>Hotel Zonne Vallei</h1>
        <p>Ontspan en geniet van luxe accommodatie, culinaire verwennerij en ongeëvenaarde gastvrijheid in het hart van de natuur.</p>
        <div class="hero-buttons">
            <a href="kamers.php" class="btn-primary">Bekijk Kamers</a>
            <a href="contact.php" class="btn-secondary">Neem Contact Op</a>
        </div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Waarom Zonne Vallei</span>
        <h2> Een Unieke Ervaring</h2>
        <div class="lijn"></div>
        <p>Wij bieden u alles wat u nodig heeft voor een perfect verblijf, van comfortabele kamers tot uitstekende service.</p>
    </div>
    <div class="voordelen-grid">
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9734;</div>
            <h3>Luxe Kamers</h3>
            <p>Onze kamers zijn elegant ingericht met alle moderne voorzieningen voor uw ultieme comfort en ontspanning.</p>
        </div>
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9829;</div>
            <h3>Culinair Genieten</h3>
            <p>Ons restaurant biedt een culinaire reis met verse, lokale ingredinten en internationale smaken.</p>
        </div>
        <div class="voordeel-kaart">
            <div class="voordeel-icoon">&#9788;</div>
            <h3>Schitterende Locatie</h3>
            <p>Gelegen in een prachtige omgeving, perfect voor wie op zoek is naar rust en natuur.</p>
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
                    <span class="kamer-prijs">Vanaf &euro;89,-</span>
                </div>
                <div class="kamer-info">
                    <h3>Standaard Kamer</h3>
                    <p>Een comfortabele kamer met alle basisvoorzieningen voor een aangenaam verblijf.</p>
                    <div class="kamer-kenmerken">
                        <span class="kamer-kenmerk">2 Personen</span>
                        <span class="kamer-kenmerk">Wifi</span>
                        <span class="kamer-kenmerk">TV</span>
                    </div>
                    <a href="kamers.php" class="btn-kamer">Meer Informatie</a>
                </div>
            </div>
            <div class="kamer-kaart">
                <div class="kamer-afbeelding" style="background-image: url('https://images.unsplash.com/photo-1590490360182-c33d57733427?w=600&q=80')">
                    <span class="kamer-prijs">Vanaf &euro;139,-</span>
                </div>
                <div class="kamer-info">
                    <h3>Luxe Kamer</h3>
                    <p>Geniet van extra ruimte, premium voorzieningen en een ademend uitzicht.</p>
                    <div class="kamer-kenmerken">
                        <span class="kamer-kenmerk">2 Personen</span>
                        <span class="kamer-kenmerk">Balkon</span>
                        <span class="kamer-kenmerk">Minibar</span>
                    </div>
                    <a href="kamers.php" class="btn-kamer">Meer Informatie</a>
                </div>
            </div>
            <div class="kamer-kaart">
                <div class="kamer-afbeelding" style="background-image: url('https://images.unsplash.com/photo-1578683010236-d716f9a3f461?w=600&q=80')">
                    <span class="kamer-prijs">Vanaf &euro;199,-</span>
                </div>
                <div class="kamer-info">
                    <h3>President Suite</h3>
                    <p>De ultieme luxe ervaring met een ruime suite, jacuzzi en panoramisch uitzicht.</p>
                    <div class="kamer-kenmerken">
                        <span class="kamer-kenmerk">4 Personen</span>
                        <span class="kamer-kenmerk">Jacuzzi</span>
                        <span class="kamer-kenmerk">Uitzicht</span>
                    </div>
                    <a href="kamers.php" class="btn-kamer">Meer Informatie</a>
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
        <p>Laat u verwennen door onze chef-kok met gerechten bereid van de beste lokale ingredinten.</p>
    </div>
    <div class="restaurant-content">
        <div>
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.5rem; color: var(--goud); margin-bottom: 20px;">Ontbijt, Lunch & Diner</h3>
            <p style="color: var(--tekst-licht); line-height: 1.8; margin-bottom: 15px;">Ons keukenteam staat elke dag voor u klaar met verse gerechten. Van een uitgebreid ontbijt tot een verfijnd driegangendiner, bij ons vindt u altijd iets naar uw smaak.</p>
            <p style="color: var(--tekst-licht); line-height: 1.8; margin-bottom: 25px;">Wij werken uitsluitend met seizoensgebonden en lokale producten om de beste kwaliteit te garanderen. Ons menu wisselt regelmatig zodat u altijd iets nieuws kunt ontdekken.</p>
            <a href="restaurant.php" class="btn-primary">Bekijk Ons Menu</a>
        </div>
        <div style="background: var(--wit); padding: 40px; border-radius: 10px; box-shadow: 0 5px 30px rgba(0,0,0,0.05); border: 1px solid rgba(181,146,92,0.15);">
            <h3 style="font-family: 'Playfair Display', serif; font-size: 1.3rem; color: var(--goud); margin-bottom: 20px;">Openingstijden Restaurant</h3>
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
        <a href="kamers.php" class="btn-wit">Reserveer Nu</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
