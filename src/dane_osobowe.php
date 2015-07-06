<?php

include_once("src/adresy.php");

class DaneOsobowe {

	static public function Update($id, $imie, $nazwisko, $pesel, $grupa_id, $ulica, $numer, $miasto, $panstwo_id) {
	
		global $mysqli;
		
		$id = intval($id);
		
		$mysqli->query("
			UPDATE dane_osobowe
			SET
				imie = '$imie',
				nazwisko = '$nazwisko',
				pesel = '$pesel',
				grupa_id = '$grupa_id'
			WHERE
				id = $id;
		") or die($mysqli->error);
		
		$result = $mysqli->query("
			SELECT 
				adres_id
			FROM dane_osobowe
			WHERE id = $id
		") or die($mysqli->error);
		
		$row = $result->fetch_assoc();
		
		Adresy::Update($row['adres_id'], $ulica, $numer, $miasto, $panstwo_id);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	
	}

}

?>