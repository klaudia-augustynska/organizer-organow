

<?php

if (isset($_GET['metoda'])) {
	if ($_GET['metoda'] == "dodaj") 
		include("pages/org/donacje-dodaj.php");
	elseif ($_GET['metoda'] == "edytuj" && isset($_GET['co']))
		include("pages/org/donacje-edytuj.php");
	elseif ($_GET['metoda'] == "usun" && isset($_GET['co']))
		include("pages/org/donacje-lista.php");
	}
else 
	include("pages/org/donacje-lista.php");


?>