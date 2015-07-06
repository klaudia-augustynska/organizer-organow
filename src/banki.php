<?php

class Banki {
	static public function GetAll() {
		
		global $mysqli;
		
		$result = $mysqli->query("
			SELECT banki.id, nazwa, ulica, numer, miasto, panstwo
			FROM banki
			JOIN adresy ON banki.adres_id = adresy.id	
			JOIN panstwa ON adresy.panstwo_id = panstwa.id
		");
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) {
				$result2 = $mysqli->query("
					SELECT COUNT(*)
					FROM donacje
					WHERE bank_id = $row[id]
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
		$result = $mysqli->query("
			SELECT banki.id, nazwa, ulica, numer, miasto, panstwo, panstwo_id
			FROM banki
			JOIN adresy ON banki.adres_id = adresy.id	
			LEFT JOIN panstwa ON adresy.panstwo_id = panstwa.id 
			WHERE banki.id = '$id'"
		);
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	
	static public function Dodaj($nazwa, $ulica, $numer, $miasto, $panstwo) {
	
	
		global $mysqli;

		$mysqli->query("
			INSERT INTO adresy 
				(id, ulica, numer, miasto, panstwo_id)
			VALUES ('', '$ulica', '$numer', '$miasto', '$panstwo');
		");
	
		$lastid = $mysqli->insert_id;
		
		$mysqli->query("
			INSERT INTO banki 
				(id, nazwa, adres_id)
			VALUES ('', '$nazwa', '$lastid');
		");
		

		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
		
	}
	
	static public function Update($id, $nazwa, $ulica, $numer, $miasto, $panstwo) {
	
		global $mysqli;
		
		$id = intval($id);
		$panstwo = intval($panstwo);
		
		$result = $mysqli->query("
			SELECT adres_id
			FROM banki
			WHERE banki.id = $id"
		);
		
		$row = $result->fetch_assoc();
		$aid = intval($row['adres_id']);
		
		$mysqli->query("
			UPDATE banki
			SET
				nazwa = '$nazwa'
			WHERE
				id = $id;
		");
		
		
		$mysqli->query("
			UPDATE adresy
			SET
				ulica = '$ulica',
				numer = '$numer',
				miasto = '$miasto',
				panstwo_id = $panstwo
			WHERE
				id = $aid;
		");
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
		
	}
	
	static public function Usun($id) {
	
		global $mysqli;
		
		$id = intval($id);
		
		$result = $mysqli->query("
			SELECT adres_id
			FROM banki
			WHERE banki.id = $id"
		) or die($mysqli->error);
		
		
		$row = $result->fetch_assoc();
		$aid = intval($row['adres_id']);
		
		// baza sama dba o to, by usunąć wszystko co związane z tym adresem, taka sprytna jest HAHAHA!
		$mysqli->query("
			DELETE FROM adresy
			WHERE id = $aid;
		") or die($mysqli->error);
		
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	
	}
}

?>