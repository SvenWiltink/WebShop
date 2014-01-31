<?php include_once("db.php"); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Hidders Hobbie Hoek | Beheer Systeem</title>
        <link rel="stylesheet" type="text/css" href="css/style.css" media="all" /> 
        <script src="js/prototype.js" type="text/javascript"></script>
        <script src="js/scriptaculous.js" type="text/javascript"></script>
        <script src="js/script.js" type="text/javascript"></script>
        <?php
        include("db.php");

        function getArtikelen() {
            include("db.php");
            $query = "SELECT artikel.art, artikel.beschrijving FROM artikel";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()) {
                echo"<li id = 'art" . $row['art'] . "'>" . $row['art'] . " - " . $row['beschrijving'] . "</li>";
            }
        }

        function getKlanten() {
            include("db.php");
            $query = "SELECT klant, naam, woonplaats FROM klant ORDER BY klant";
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()) {
                echo"<li id = 'klant" . $row['klant'] . "'>" . $row['klant'] . " - " . $row['naam'] . " - " . $row['woonplaats'] . "</li>";
            }
        }

        function getVerkoopVandaag() {
            include("db.php");
            $date = date("Y-m-d");
            $query = "SELECT klant.naam, artikel.beschrijving, artikel.art
					FROM verkoop
					JOIN klant ON klant.klant = verkoop.klant
					JOIN artikel ON artikel.art = verkoop.art
					WHERE datum = " . $date;
            $result = $mysqli->query($query);
            while ($row = $result->fetch_array()) {
                echo"<li id = 'art" . $row['art'] . "'>" . $row['art'] . " - " . $row['beschrijving'] . " - " . $row['naam'] . "</li>";
            }
        }
        ?>

    </head>

    <body>
        <div id="container">
            <div id="header">
                <img src ="img/hhh.png" alt = "logo"/>
            </div>

            <div id="search">
                <fieldset id="zoekartikel">
                    <legend>Zoek artikel</legend>
                    <label>Artikelnr</label><input type="text" id="searchArt" /><br />
                    <label>Beschrijving</label><input type="text" id="searchBeschrijving" /><br />   
                </fieldset>
                <fieldset id="zoekklant">
                    <legend>Zoek klant</legend>
                    <label>Klantnr</label><input type="text" id="searchKlant" /><br />
                    <label>Naam</label><input type="text" id="searchNaam" /><br />
                    <label>Woonplaats</label><input type="text" id="searchWoonplaats" /><br />
                </fieldset>
            </div><!-- End search div-->

            <div id="left">
                <div class="column" id="artikelen">
                    <ul>
                        <?php
                        getArtikelen();
                        ?>
                    </ul>
                </div><!-- End artikelen div-->

                <div class="column" id="klanten">
                    <ul>
                        <?php
                        getKlanten();
                        ?>
                    </ul>
                </div><!-- End klanten div-->

                <div id="verkopen">
                    <div id="divheader">Verkopen deze dag</div>
                    <ul id ="verkooplist">
                        <?php
                        getVerkoopVandaag();
                        ?>
                        <!-- This list should show all 'verkopen' that are done this day-->
                    </ul>
                </div><!-- End verkopen div-->
            </div><!-- End left div-->

            <div id="right">		
                <fieldset>
                    <legend>Voeg bestelling toe</legend>
                    <div id="form">
                        <label>Klant</label> <label id="klant"></label><br/>
                        <label>Naam</label> <input type="text" name="naam" id="naam"/>  <br/>
                        <label>Voorl</label> <input type="text" name="voorl" id="voorl" maxlength="5"/>  <br/>
                        <label>Adres</label> <input type="text" name="adres" id="adres" maxlength="20"/>  <br/>
                        <label>Postcode</label> <input type="text" name="postc" id="postc" maxlength="7"/> <br/>
                        <label>Woonplaats</label> <input type="text" name="woonplaats" id="woonplaats" maxlength="15"/> <br/>
                        <label>Schuld</label> <input type="text" name="schuld" id="schuld" maxlength="9"/> <br/>
                        <br/>
                        <label>Art</label> <label id="art"></label><br/>
                        <label>Beschrijving</label> <input type="text" name="beschrijving" id="beschrijving" maxlength="16"/>  <br/>
                        <label>Kleur</label> <input type="text" name="kleur" id="kleur" maxlength="10"/>  <br/>
                        <label>Voorraad</label> <input type="text" name="voorraad" id="voorraad" maxlength="8"/>  <br/>
                        <label>Prijs</label> <input type="text" name="prijs" id="prijs" maxlength="9"/> <br/>
                        <label>Srtc</label> <input type="text" name="srtc" id="srtc" maxlength="8"/> <br/>
                        <br/>
                        <label>Hoeveelheid</label> <input type="text" name="hoeveelheid" id="hoeveelheid"/> <br/>
                        <label>Afdeling</label> 
                        <select id="afd" name="afd">
                        </select>  <br/>
                        <label>Bedrag</label> &euro; <span id="bedrag">0.00</span><br/>
                        <label>Aanbetaling</label> <input type="text" name="aanbet" id="aanbet"/> <br/>
                        <button type="button" id="submit">Voeg verkoop toe</button>
                    </div>
                </fieldset>
            </div><!-- End right div-->

            <div id="footer">
                Powered by Sven&amp;Co. &copy;
            </div>
        </div><!-- End container div-->
    </body>
</html>
