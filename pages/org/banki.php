

<?php

include("src/banki.php");

if (isset($_GET['metoda'])) {
	if ($_GET['metoda'] == "dodaj") 
		include("pages/org/banki-dodaj.php");
	elseif ($_GET['metoda'] == "edytuj" && isset($_GET['co']))
		include("pages/org/banki-edytuj.php");
	elseif ($_GET['metoda'] == "usun" && isset($_GET['co']))
		include("pages/org/banki-lista.php");
	}
else 
	include("pages/org/banki-lista.php");


?>