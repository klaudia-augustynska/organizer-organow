<?php

include_once("src/dane_osobowe.php");
include_once("src/role.php");

class Uzytkownicy {

	public $id, $email, $imie, $nazwisko, $pesel, $miasto, $numer, $ulica, $panstwo, $opcje;

	public function __construct ($id) {
		$a = $this->Get($id);
		$this->id = $a['id'];
		$this->email = $a['email'];
		$this->imie = $a['imie'];
		$this->nazwisko = $a['nazwisko'];
		$this->pesel = $a['pesel'];
		$this->miasto = $a['miasto'];
		$this->numer = $a['numer'];
		$this->ulica = $a['ulica'];
		$this->panstwo = $a['panstwo'];
		$this->opcje = $this->GetOpcje();
	}
	
	protected function GetOpcje() {
		global $mysqli;
		
		$id = intval($this->id);
		
		$result = $mysqli->query("
			SELECT DISTINCT opcja_id
			FROM uzytkownicytorole
				JOIN roletoopcje ON uzytkownicytorole.rola_id = roletoopcje.rola_id
			WHERE uzytkownicytorole.uzytkownik_id = $id
			") or die($mysqli->error);

		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_array()) 
				$tablica[] = $row[0];
			return $tablica;
		}
		return NULL;
	}
	
	static public function SprawdzOpcje($user, $opcja) {
		global $mysqli;
		
		$opcja = intval($opcja);
		
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicytorole
				JOIN roletoopcje ON uzytkownicytorole.rola_id = roletoopcje.rola_id
			WHERE uzytkownicytorole.uzytkownik_id = $user
				AND opcja_id = $opcja
			") or die($mysqli->error);

		if ($result->fetch_array()[0] == 0)
			return false;
		return true;
	}
	
	static public function EmailOk($email) {
	
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicy
			WHERE email = '$email'"
		) or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 0)
			return true;
		return false;
		
	}
	
	static public function HasloOK($id, $haslo) {
	
		global $mysqli;
		$result = $mysqli->query("
			SELECT COUNT(*)
			FROM uzytkownicy
			WHERE id = '$id'
				AND haslo = '$haslo'"
		) or die($mysqli->error);
		
		if ($result->fetch_array()[0] == 1)
			return true;
		return false;
		
	}

	static public function Dodaj($email, $haslo, $imie, $nazwisko, $pesel, $grupa = NULL) {
	
		global $mysqli;
		
		if (self::EmailOk($email) == false) return -1;
		
		$mysqli->query("
			INSERT INTO adresy 
				(id)
			VALUES ('');
		") or die($mysqli->error);
		
		$lastid = $mysqli->insert_id;
		
		if ($grupa == NULL)		
		$mysqli->query("
			INSERT INTO dane_osobowe 
				(id, imie, nazwisko, pesel, adres_id)
			VALUES ('', '$imie', '$nazwisko', '$pesel', $lastid);
		") or die($mysqli->error);
		
		else
		$mysqli->query("
			INSERT INTO dane_osobowe 
				(id, imie, nazwisko, pesel, adres_id, grupa_id)
			VALUES ('', '$imie', '$nazwisko', '$pesel', $lastid, '$grupa');
		") or die($mysqli->error);
		
		$lastid = $mysqli->insert_id;
		
		$mysqli->query("
			INSERT INTO uzytkownicy 
				(id, email, haslo, dane_osobowe_id)
			VALUES ('', '$email', '$haslo', $lastid);
		") or die($mysqli->error);
		
		$lastid = $mysqli->insert_id;
		
		$mysqli->query("
			INSERT INTO uzytkownicytorole 
				(uzytkownik_id, rola_id)
			VALUES ($lastid, 1);
		") or die($mysqli->error);
				
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	
	}
	
	static public function Uwierzytelnianie($email, $haslo) {
	
		global $mysqli;
		
		$result = $mysqli->query("
			SELECT id, email, haslo
			FROM uzytkownicy
			WHERE email = '$email'
				AND $haslo = '$haslo'"
		) or die($mysqli->error);

		
		if ($result->num_rows > 0) {
			$t = $result->fetch_assoc();
			return intval($t['id']);
		}
		return 0;
	
	}
	
	static public function Get($id) {
	
		global $mysqli;
		
		$id = intval($id);
		
		$result = $mysqli->query("
			SELECT uzytkownicy.id, email, imie, nazwisko, pesel, miasto, numer, ulica, panstwo, panstwo_id, grupa_id, stanowisko_id
			FROM uzytkownicy
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
				JOIN adresy ON dane_osobowe.adres_id = adresy.id
				LEFT JOIN panstwa ON adresy.panstwo_id = panstwa.id
			WHERE uzytkownicy.id = $id
		") or die($mysqli->error);
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	
	static public function GetRole ($id) {
		global $mysqli;
		
		$id = intval($id);
		
		$result = $mysqli->query("
			SELECT rola_id
			FROM uzytkownicytorole
			WHERE uzytkownik_id = $id
		") or die($mysqli->error);
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_array()) 
				$tablica[] = $row[0];
			return $tablica;
		}
		return NULL;
	}
	
	static public function GetStanowiska ($id) {
		global $mysqli;
		
		$id = intval($id);
		
		$result = $mysqli->query("
			SELECT stanowisko_id
			FROM uzytkownicytostanowiska
			WHERE uzytkownik_id = $id
		") or die($mysqli->error);
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_array()) 
				$tablica[] = $row[0];
			return $tablica;
		}
		return NULL;
	}
	
	static public function GetAllDawcy() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT 
				uzytkownik_id AS 'id',
				imie, 
				nazwisko, 
				email,
				pesel, 
				COUNT(donacje.id) AS 'donacji'
			FROM uzytkownicytorole
				JOIN uzytkownicy ON uzytkownik_id = uzytkownicy.id
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
				LEFT JOIN donacje ON uzytkownik_id = donacje.dawca_id
			WHERE rola_id = 1
			GROUP BY uzytkownik_id
		") or die($mysqli->error);
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) 
				$tablica[] = $row;
			return $tablica;
		}
		return NULL;
	}
	
	static public function GetAllPracownicy() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT 
				uzytkownik_id AS 'id',
				imie, 
				nazwisko
			FROM uzytkownicytorole
				JOIN uzytkownicy ON uzytkownik_id = uzytkownicy.id
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
			WHERE rola_id = 2
		") or die($mysqli->error);
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) {
				$result2 = $mysqli->query("
					SELECT stanowiska.nazwa
					FROM stanowiska
						JOIN uzytkownicytostanowiska ON stanowisko_id = stanowiska.id
					WHERE uzytkownik_id = $row[id]
				");
				if ($result2->num_rows == 0)
					$row['stanowiska'] = "&mdash;";
				else {
					$a = array();
					while ($a[] = $result2->fetch_array()[0]);
					$s = "";
					for ($i = 0; $i < count($a)-2; $i++)
						$s .= $a[$i] . ", ";
					$s .= $a[$i];
						
					$row['stanowiska'] = $s;
				}
				
				$result2 = $mysqli->query("
					SELECT SUM(pensja)
					FROM stanowiska
						JOIN uzytkownicytostanowiska ON stanowisko_id = stanowiska.id
					WHERE uzytkownik_id = $row[id]
				");
				$row['ile_zarabia'] = $result2->fetch_array()[0];
				$tablica[] = $row;
			}
			return $tablica;
		}
		return NULL;
	}
	
	static public function Update(
		$id, $email, $imie, 
		$nazwisko, $pesel, $grupa_id, 
		$stanowiska, $ulica, $numer, 
		$miasto, $panstwo_id, $role) {
		
		global $mysqli;
		
		$id = intval($id);
				
		$mysqli->query("
			UPDATE uzytkownicy
			SET
				email = '$email'
			WHERE
				id = $id;
		") or die($mysqli->error);
		
		$result = $mysqli->query("
			SELECT dane_osobowe_id
			FROM uzytkownicy
			WHERE id = $id
		") or die($mysqli->error);
		
		$row = $result->fetch_assoc();
		
		DaneOsobowe::Update($row['dane_osobowe_id'], $imie, $nazwisko, $pesel, $grupa_id, $ulica, $numer, $miasto, $panstwo_id);
		
		$mysqli->query("
			DELETE FROM uzytkownicytorole
			WHERE uzytkownik_id = $id;
		") or die($mysqli->error);
		
		foreach ($role as $r)
			$mysqli->query("
				INSERT INTO uzytkownicytorole
				(uzytkownik_id, rola_id)
				VALUES ($id, '$r');
			") or die($mysqli->error);
			
		
		$mysqli->query("
			DELETE FROM uzytkownicytostanowiska
			WHERE uzytkownik_id = $id;
		") or die($mysqli->error);
		
		if ($stanowiska != NULL) {
			foreach ($stanowiska as $s)
				$mysqli->query("
					INSERT INTO uzytkownicytostanowiska
					(uzytkownik_id, stanowisko_id)
					VALUES ($id, '$s');
				") or die($mysqli->error);
			Role::Nadaj($id, 2);
		}
		else {
			Role::Zdejmij($id, 2);
		}
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	}
	
	
	static public function UpdateHaslo(
		$id, $haslo) {
		
		global $mysqli;
		
		$mysqli->query("
			UPDATE uzytkownicy
			SET
				haslo = '$haslo'
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
			SELECT adres_id
			FROM uzytkownicy
				JOIN dane_osobowe ON dane_osobowe_id = dane_osobowe.id
			WHERE uzytkownicy.id = $id
		") or die($mysqli->error);
		
		$mysqli->query("
			DELETE FROM uzytkownicytorole
			WHERE uzytkownik_id = $id;
		") or die($mysqli->error);
		
		
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