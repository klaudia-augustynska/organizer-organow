<?php

class Role {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM role
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
		$result = $mysqli->query("SELECT * FROM role WHERE id = '$id'");
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
        
	static public function Dodaj($nazwa) {
		global $mysqli;

		$mysqli->query("
			INSERT INTO role 
				(id, nazwa)
			VALUES ('', '$nazwa');
		") or die($mysqli->error);

		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
		
	static public function Usun($id) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM role
			WHERE id = $id;
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0) return -1;
		
		$mysqli->query("
			DELETE FROM role
			WHERE id = $id;
		") or die($mysqli->error);
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	static public function Nadaj($id, $rola) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicytorole
			WHERE uzytkownik_id = $id
				AND rola_id = $rola
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] > 0) return 0;
		
		$mysqli->query("
			INSERT INTO uzytkownicytorole
				(uzytkownik_id, rola_id)
			VALUES ('$id', '$rola')
		") or die($mysqli->error);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	static public function Zdejmij($id, $rola) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM role
			WHERE id = $id;
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0) return -1;
		
		$mysqli->query("
			DELETE FROM uzytkownicytorole
			WHERE uzytkownik_id = $id
				AND rola_id = $rola
		") or die($mysqli->error);
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	static public function JestDostep($id, $rola) {
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicytorole
			WHERE uzytkownik_id = $id
				AND rola_id = $rola
		") or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0) return 0;
		return 1;
	}

}

?>