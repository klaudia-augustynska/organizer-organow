<?php

class Opcje {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM opcje
		");
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) 
				$tablica[] = $row;
			return $tablica;
		}
		return NULL;
	}

	static public function GetForId($id) {
		global $mysqli;
		
		$result = $mysqli->query("
			SELECT DISTINCT opcja_id
			FROM roletoopcje
			WHERE rola_id = $id	
			") or die($mysqli->error);

		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_array()) 
				$tablica[] = $row[0];
			return $tablica;
		}
		return NULL;
	}
	
	static public function Dodaj($nazwa) {	
		global $mysqli;

		$mysqli->query("
			INSERT INTO opcje 
				(id, nazwa)
			VALUES ('', '$nazwa');
		") or die($mysqli->error);
	
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}

	static public function Update($id, $opcje) {
		global $mysqli;
		$mysqli->query("
			DELETE FROM roletoopcje
			WHERE rola_id = $id;
		") or die($mysqli->error);
		
		foreach ($opcje as $o)
			$mysqli->query("
				INSERT INTO roletoopcje
				(rola_id, opcja_id)
				VALUES ($id, '$o');
			") or die($mysqli->error);
	
                if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
}

?>