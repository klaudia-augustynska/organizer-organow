<?php

class Stanowiska {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM stanowiska
		");
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) 
				$tablica[] = $row;
			return $tablica;
		}
		return NULL;
	}

	static public function Get($id) {
	
		global $mysqli;
		$result = $mysqli->query("SELECT * FROM stanowiska WHERE id = '$id'");
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	static public function Dodaj($nazwa, $pensja) {
        global $mysqli;
            
        $mysqli->query("
			INSERT INTO stanowiska 
				(id, nazwa, pensja)
			VALUES ('', '$nazwa', '$pensja');
        ") or die($mysqli->error);
		
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	static public function Usun($id) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM stanowiska
			WHERE id = $id;
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0) return -1;
		
		$mysqli->query("
			DELETE FROM stanowiska
			WHERE id = $id;
		") or die($mysqli->error);
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
}

?>