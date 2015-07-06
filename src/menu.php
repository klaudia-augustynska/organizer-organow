<?php
include_once("src/uzytkownicy.php");

class Menu {

	static public function GetAll() {
		
		global $mysqli;
		$result = $mysqli->query("
			SELECT *
			FROM menu
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
		$result = $mysqli->query("SELECT * FROM menu WHERE id = '$id'");
		
		if ($result->num_rows > 0) {
			return $result->fetch_assoc();
		}
		return NULL;
	
	}
	
	static public function Generuj($user, $typ, $parent = 0) {
		global $mysqli;
		
		$result = $mysqli->query("
			SELECT * 
			FROM menu 
			WHERE 
				parent_id = $parent
				AND typ = $typ
		");
		
		if ($result->num_rows > 0) {
			$tablica  = array();
			while ($row = $result->fetch_assoc()) {
			
				if ($row['naglowek'] == 0) {
					if (!Uzytkownicy::SprawdzOpcje($user, $row['opcja_id']))
						continue;
					print "<li><a href=\"$row[adres]\">$row[etykieta]</a></li>";
				}
				else
					print "<li>$row[etykieta] ";
					
				self::Generuj($user, $typ, $row['id']);
				print "</li>";
			}
			return $tablica;
		}
	}
}

?>