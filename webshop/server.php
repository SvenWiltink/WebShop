<?php
include("db.php");
if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getArtikel'){
	if(isset($_REQUEST['art'])){
		$art = $mysqli->real_escape_string($_REQUEST['art']);
		$query = "SELECT * FROM artikel JOIN verkart ON verkart.art = artikel.art WHERE artikel.art =". $art;
		$result = $mysqli->query($query);
		$rows = $result->num_rows;
		$row = $result->fetch_array();
                echo $row['beschrijving'].",". $row['kleur'].",". $row['voorraad'].",". $row['prijs'].",". $row['srtc'].",". $row['afd'];
		for($i = 1; $i < $rows; $i++){
                    $row = $result->fetch_array();
                    echo ", ".$row["afd"];
                }
	}else{
		die("error: wrong values given");
	}
}
else if (isset($_REQUEST['mode']) && $_REQUEST['mode']=='getKlant'){
	//Request all the information from an customer
	if(isset($_REQUEST['klant'])){
		$klant = $mysqli->real_escape_string($_REQUEST['klant']);
		$query = "SELECT * FROM klant WHERE klant =". $klant;
		$result = $mysqli->query($query);
		
		while($row = $result->fetch_array()){
			echo $row['naam'].",". $row['voorl'].",". $row['adres'].",". $row['postc'].",". $row['woonplaats'].",". $row['schuld'];
		}
	}else{
		die("error: wrong values given");
	}
}
else if(isset($_REQUEST['mode']) && $_REQUEST['mode']=='saveAankoop'){
	//Save a purchase to the database
}
else{
	die("error: wrong values given");
}
?>