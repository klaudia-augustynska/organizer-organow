<?php

class Donacje {
	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT 
				donacje.id, 
				DATE(data) AS 'data',
				organy.nazwa AS 'organ',
				banki.nazwa AS 'bank',
				dane_osobowe.imie AS 'imie',
				dane_osobowe.nazwisko AS 'nazwisko'
			FROM donacje
				LEFT JOIN banki ON bank_id = banki.id
				JOIN organy ON organ_id = organy.id
				JOIN uzytkownicy ON dawca_id = uzytkownicy.id
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
		") or die($mysqli->error);
		
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
		$result = $mysqli->query("
			SELECT 
				donacje.id, 
				DATE(data) AS 'data',
				organy.nazwa AS 'organ',
				banki.nazwa AS 'bank',
				bank_id,
				dane_osobowe.imie AS 'imie',
				dane_osobowe.nazwisko AS 'nazwisko',
				grupa,
				rh
			FROM donacje
				LEFT JOIN banki ON bank_id = banki.id
				JOIN organy ON organ_id = organy.id
				JOIN uzytkownicy ON dawca_id = uzytkownicy.id
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
				JOIN grupy_krwi ON grupa_id = grupy_krwi.id
			WHERE donacje.id = '$id'"
		);
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	
	static public function Dodaj($organid, $dawcaid, $bankid = NULL) {
	
		global $mysqli;
		
		if (!($id = self::GetIdDawcy($dawcaid)))
			return -1;

		if ($bankid == NULL)
		$mysqli->query("
			INSERT INTO donacje 
				(id, organ_id, dawca_id)
			VALUES ('', '$organid', $id);
		") or die($mysqli->error);
		
		else
		$mysqli->query("
			INSERT INTO donacje 
				(id, organ_id, dawca_id, bank_id)
			VALUES ('', '$organid', $id, '$bankid');
		") or die($mysqli->error);

		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
		
	}
	
	static public function Update($id, $bankid) {
	
		global $mysqli;
		
		$id = intval($id);
		
		$mysqli->query("
			UPDATE donacje
			SET
				bank_id = '$bankid'
			WHERE
				id = $id;
		") or die($mysqli->error);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
		
	}
	
	static public function Usun($id) {
	
		global $mysqli;
		
		$id = intval($id);
		
		$result = $mysqli->query("
			DELETE FROM donacje
			WHERE id = $id"
		) or die($mysqli->error);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	
	}
	
	static public function GetIdDawcy($id) {
	
		global $mysqli;

		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicy
			WHERE id = '$id'
		") or die($mysqli->error);
		$row = $result->fetch_array();
		
		if (intval($row[0]) == 1) return intval($id);
		
		$result = $mysqli->query("
			SELECT id
			FROM uzytkownicy
			WHERE email = '$id'
		") or die($mysqli->error);
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
			return intval($row['id']);
		}
		return 0;
	}
}

?>