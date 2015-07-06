<?php

class Adresy {

	static public function Update($id, $ulica, $numer, $miasto, $panstwo_id) {
	
		global $mysqli;
		
		$id = intval($id);
			
		if ($panstwo_id > 0)
		$mysqli->query("
			UPDATE adresy
			SET
				ulica = '$ulica',
				numer = '$numer',
				miasto = '$miasto',
				panstwo_id = '$panstwo_id'
			WHERE
				id = $id;
		") or die($mysqli->error);
		
		else
		$mysqli->query("
			UPDATE adresy
			SET
				ulica = '$ulica',
				numer = '$numer',
				miasto = '$miasto'
			WHERE
				id = $id;
		") or die($mysqli->error);
		
		if ($mysqli->commit()) return 0;
		return $mysqli->errno;
	
	}

}

?>