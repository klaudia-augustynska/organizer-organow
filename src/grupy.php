<?php

class Grupy {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM grupy_krwi
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
		$result = $mysqli->query("SELECT * FROM grupy_krwi WHERE id = '$id'");
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
        
        static public function Dodaj($literka, $rh) {
            global $mysqli;
            
            if ($rh == 0) {
                $mysqli->query("
			INSERT INTO grupy_krwi 
				(id, grupa, rh)
			VALUES ('', '$literka', FALSE);
		") or die($mysqli->error);
            } else {
		$mysqli->query("
			INSERT INTO grupy_krwi 
				(id, grupa, rh)
			VALUES ('', '$literka', TRUE);
		") or die($mysqli->error);
            }

	
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
        }
        
        static public function Usun($id) {
            global $mysqli;
			$result = $mysqli->query("
				SELECT COUNT(*)
				FROM grupy_krwi
				WHERE id = $id;
			") or die($mysqli->error);
			
			if ($result->fetch_array()[0] == 0) return -1;
			
			$mysqli->query("
				DELETE FROM grupy_krwi
				WHERE id = $id;
			") or die($mysqli->error);
			if ($mysqli->commit()) return 0;
			return $mysqli->errno;
        }

}

?>