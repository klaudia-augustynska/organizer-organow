<?php

class Organy {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM organy
		");
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) {
				$result2 = $mysqli->query("
					SELECT COUNT(*)
					FROM donacje
					WHERE organ_id = $row[id]
				");
				$row['ilosc'] = $result2->fetch_array()[0];
				$tablica[] = $row;
			}
			return $tablica;
		}
		return NULL;
	}

	static public function Get($id) {
	
		global $mysqli;
		$result = $mysqli->query("SELECT * FROM organy WHERE id = '$id'");
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	
	static public function Dodaj($nazwa, $cena) {
        global $mysqli;
            
        $mysqli->query("
			INSERT INTO organy 
				(id, nazwa, cena)
			VALUES ('', '$nazwa', '$cena');
        ") or die($mysqli->error);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	static public function Usun($id) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM organy
			WHERE id = $id;
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0) return -1;
		
		$mysqli->query("
			DELETE FROM organy
			WHERE id = $id;
		") or die($mysqli->error);
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}

}

?>