

<?php

include_once("src/role.php");

if (isset($_GET['metoda'])) {
	if ($_GET['metoda'] == "opcje") 
		include("pages/set/role-opcje.php");
	else 
		include("pages/set/role-lista.php");
	}
else 
	include("pages/set/role-lista.php");


?>