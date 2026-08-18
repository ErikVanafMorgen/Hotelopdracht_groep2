<?php $pagina_titel = 'Restaurant'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>

<section class="restaurant-hero">
    <div>
        <h1>Ons Restaurant</h1>
        <p>Geniet van culinaire verwennerij met verse, lokale ingredienten en internationale smaken</p>
        <div class="breadcrumb"><a href="index.php">Home</a> / Restaurant</div>
    </div>
</section>

<section class="sectie">
    <div class="sectie-kop">
        <span class="ondertitel">Menu</span>
        <h2>Onze Gerechten</h2>
        <div class="lijn"></div>
        <p>Van smaakvolle voorgerechten tot verfijnde desserts, ons menu biedt voor ieder wat wils.</p>
    </div>

    <div class="restaurant-content">
        <div class="menu-sectie">
            <h3>Ontbijt</h3>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Verse Croissant met Boter & Jam</h4>
                    <p>Huisgemaakt, vers uit de oven</p>
                </div>
                <span class="menu-item-prijs">&euro;4,50</span>
            </div>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Uitgebreid Ontbijt</h4>
                    <p>Eieren, spek, brood, kaas, fruit, yoghurt en vers geperste jus</p>
                </div>
                <span class="menu-item-prijs">&euro;14,95</span>
            </div>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Pannenkoeken</h4>
                    <p>Drie pannenkoeken met Nutella, fruit of stroop</p>
                </div>
                <span class="menu-item-prijs">&euro;8,50</span>
            </div>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Smoothie Bowl</h4>
                    <p>Acai, banaan, granola, vers fruit en chia zaden</p>
                </div>
                <span class="menu-item-prijs">&euro;9,50</span>
            </div>

            <h3 style="margin-top: 40px;">Lunch</h3>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Caesar Salade</h4>
                    <p>Romaine, parmezaan, croutons, huisgemaakte Caesar dressing</p>
                </div>
                <span class="menu-item-prijs">&euro;12,50</span>
            </div>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Club Sandwich</h4>
                    <p>Kip, spek, tomaat, sla, op drie lagen brood</p>
                </div>
                <span class="menu-item-prijs">&euro;13,50</span>
            </div>
            <div class="menu-item">
                <div class="menu-item-nam">
                    <h4>Zalm Toast</h4>
                    <p>Gerookte zalm, roomkaas, avocado op artisan brood</p>
                </div>
                <span class="menu-item-prijs">&euro;14,50</span>
            </div>
        </div>

        <div>
            <div class="menu-sectie">
                <h3>Diner</h3>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Voorgerecht: Zalm Tartare</h4>
                        <p>Fijne zalm, avocado mousse, limoen, sesam</p>
                    </div>
                    <span class="menu-item-prijs">&euro;14,50</span>
                </div>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Hoofdgerecht: Ribeye Steak</h4>
                        <p>250g ribeye, rode wijnsaus, seizoensgroenten, aardappelen</p>
                    </div>
                    <span class="menu-item-prijs">&euro;29,50</span>
                </div>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Hoofdgerecht: Zeebaars</h4>
                        <p>Frisse zeebaars, saffraan risotto, groene asperges</p>
                    </div>
                    <span class="menu-item-prijs">&euro;26,50</span>
                </div>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Hoofdgerecht: Vegetarische Risotto</h4>
                        <p>Paddenstoelen risotto, truffelolie, parmezaan</p>
                    </div>
                    <span class="menu-item-prijs">&euro;18,50</span>
                </div>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Dessert: Creme Brulee</h4>
                        <p>Klassieke vanille creme brulee met karamelsuiker</p>
                    </div>
                    <span class="menu-item-prijs">&euro;8,50</span>
                </div>
                <div class="menu-item">
                    <div class="menu-item-nam">
                        <h4>Dessert: Chocolade Fondant</h4>
                        <p>Warm chocoladetaartje met vanille-ijs</p>
                    </div>
                    <span class="menu-item-prijs">&euro;9,50</span>
                </div>
            </div>

            <div class="openingstijden" style="margin-top: 30px;">
                <h3>Openingstijden</h3>
                <div class="uren-rij"><span class="dag">Maandag - Vrijdag</span><span class="tijd">07:00 - 22:00</span></div>
                <div class="uren-rij"><span class="dag">Zaterdag</span><span class="tijd">08:00 - 23:00</span></div>
                <div class="uren-rij"><span class="dag">Zondag</span><span class="tijd">08:00 - 21:00</span></div>
                <div class="uren-rij"><span class="dag">Feestdagen</span><span class="tijd">09:00 - 22:00</span></div>
            </div>
        </div>
    </div>
</section>

<section class="sectie" style="background: var(--wit); padding: 80px 40px; max-width: none;">
    <div class="reservering-banner" style="max-width: 1200px; margin: 0 auto;">
        <h3>Tafel Reserveren</h3>
        <p>Reserveer een tafel in ons restaurant voor een culinaire ervaring die u niet snel zult vergeten.</p>
        <a href="contact.php" class="btn-wit">Reserveer een Tafel</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
