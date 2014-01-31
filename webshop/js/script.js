window.onload = function() {
    $("submit").observe('click', saveAankoop);
    $("searchArt").observe('keyup', updateListArtikel);
    $("searchBeschrijving").observe('keyup', updateListArtikel);
    $("searchKlant").observe('keyup', updateListKlant);
    $("searchNaam").observe('keyup', updateListKlant);
    $("searchWoonplaats").observe('keyup', updateListKlant);
    $("hoeveelheid").observe('keyup', updateBedrag);
    var artikelen = $$("#left #artikelen li");
    for (var i = 0; i < artikelen.length; i++) {
        artikelen[i].observe('click', artSelect);
    }
    var klanten = $$("#left #klanten li");
    for (var i = 0; i < klanten.length; i++) {
        klanten[i].observe('click', klantSelect);
    }
}
/*This functie is called when an artikel is selected in the list*/
function artSelect(art) {
    var artikelen = $$("#left #artikelen li");
    for (var i = 0; i < artikelen.length; i++) {
        artikelen[i].removeClassName("selected");
    }
    this.addClassName("selected");
    var art = this.id;
    art = art.replace("art", "");
    new Ajax.Request(
            "server.php",
            {
                method: "get",
                parameters: {mode: "getArtikel", art: art},
                onSuccess: function(ajax) {
                    onArtikelCompleted(ajax);
                },
            }
    );

}
function onArtikelCompleted(ajax) {
    $('hoeveelheid').value = "";
    $('aanbet').value = "";
    var afd = $('afd');
    while (afd.firstChild) {
        afd.removeChild(afd.firstChild);
    }
    var objects = ajax.responseText.split(",");
    for (var i = 0; i < objects.length; i++) {
        if (i == 0) {
            $('beschrijving').setValue(objects[i]);
        } else if (i == 1) {
            $('kleur').setValue(objects[i]);
        }
        if (i == 2) {
            $('voorraad').setValue(objects[i]);
        } else if (i == 3) {
            $('prijs').setValue(objects[i]);
        }
        if (i == 4) {
            $('srtc').setValue(objects[i]);
        } else if (i >= 5) {
            var opt = document.createElement("option");
            opt.value = objects[i];
            opt.innerHTML = objects[i];
            $('afd').appendChild(opt);
        }
    }
}

/*This  functieis ois called when a 'klant' is selected in the list*/
function klantSelect(klant) {
    var klanten = $$("#left #klanten li");
    for (var i = 0; i < klanten.length; i++) {
        klanten[i].removeClassName("selected");
    }
    this.addClassName("selected");
    var klant = this.id;
    klant = klant.replace("klant", "");
    new Ajax.Request(
            "server.php",
            {
                method: "get",
                parameters: {mode: "getKlant", klant: klant},
                onSuccess: function(ajax) {
                    onKlantCompleted(ajax);
                },
            }
    );

}
function onKlantCompleted(ajax) {
    var objects = ajax.responseText.split(",");
    for (var i = 0; i < objects.length; i++) {
        if (i == 0) {
            $('naam').setValue(objects[i]);
        } else if (i == 1) {
            $('voorl').setValue(objects[i]);
        }
        if (i == 2) {
            $('adres').setValue(objects[i]);
        } else if (i == 3) {
            $('postc').setValue(objects[i]);
        }
        if (i == 4) {
            $('woonplaats').setValue(objects[i]);
        } else if (i == 5) {
            $('schuld').setValue(objects[i]);
        }
    }
}

/*This functie should be called to update the artikel fields*/
function updateFieldsArtikel(ajax) {
    //call transformIntoArray and update all information fields on the right to display all artikel information

    //Create new options for every afdeling	 

    updateBedrag();

}

/*Deze functie vult daadwerkelijk de klant velden in*/
function updateFieldsKlant(ajax) {
    //call transformIntoArray and update all information fields on the right to display all klant information
}

/*The bedrag (=hoeveelheid * artikel.prijs) is calculated and displayed in this function*/
function updateBedrag(event) {

}

/*This function is called when an artikel is searched using the search fields */
function updateListArtikel(event) {

}

/*This function is called when a klant is searched using the search fields*/
function updateListKlant(event) {

}


/*
 This function performs a Ajax request that connects with server.php where a sale is added
 */
function saveAankoop() {

}

/*When a sale is done, update the list of 'verkopen', using Scriptaculous!!!*/
function updateVerkopen(ajax) {

}

function transformIntoArray(accessoriesString) {
    return accessoriesString.strip().split(";");
}

function ajaxFailure(ajax, exception) {
    alert("Error making Ajax request:" +
            "\n\nServer status:\n" + ajax.status + " " + ajax.statusText +
            "\n\nServer response text:\n" + ajax.responseText);
    if (exception) {
        throw exception;
    }
}
