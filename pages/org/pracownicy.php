

<?php

if (isset($_GET['metoda'])) {
	if ($_GET['metoda'] == "dodaj") 
		include("pages/org/pracownicy-dodaj.php");
	elseif ($_GET['metoda'] == "edytuj" && isset($_GET['co']))
		include("pages/org/uzytkownicy-edytuj.php");
	elseif ($_GET['metoda'] == "usun" && isset($_GET['co']))
		include("pages/org/pracownicy-lista.php");
	}
else 
	include("pages/org/pracownicy-lista.php");


?>