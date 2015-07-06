<?php

if ($_SESSION['id'] == 0)
	include("pages/home-witaj.php");
else {
	include("pages/home-organizer.php");
}