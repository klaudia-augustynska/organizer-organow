<?php

if ($_SESSION['id'] == 0)
	include("pages/logowanie-formularz.php");
else {
	header($home);
	exit();
}