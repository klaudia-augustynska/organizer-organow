<?php

function zalogowany () {
	if (!isset($_SESSION['id']) || $_SESSION['id'] == 0)
		return false;
	return true;
}

include_once("src/uzytkownicy.php");

if (isset($_GET['id']))
	$id = $_GET['id'];
else
	$id = "home";

$mysqli = new mysqli("localhost", "root", "", "projekt");
if ($mysqli->connect_errno) {
	echo "Blad: mysqli";
	exit();
}
$mysqli->autocommit(FALSE);
$mysqli->query("SET NAMES 'utf8'");
$mysqli->commit();


$home = "/projekt";
session_start();
//session_destroy();

if (!isset($_SESSION['id']))
	$_SESSION['id'] = 0;

?>


<!DOCTYPE HTML>
<html lang="pl">
<head>
	<meta charset="utf-8" />
	<title>Organizer Organów</title>
	<link href="style.css" rel="stylesheet" />
</head>
<body>

<nav>

<?php
if ($_SESSION['id'] == 0) {
?>

<ul id="menu">
	<li><a href="<?=$home;?>">Home</a></li>
	<li><a href="?id=rejestracja">Rejestracja</a></li>
	<li><a href="?id=logowanie">Zaloguj</a></li>
</ul>

<?php
} else {
?>

<ul id="menu">
	<li><a href="<?=$home;?>">Twój Organizer</a></li>
	<li><a href="?id=ustawienia">Ustawienia</a></li>
	<li><a href="?id=wyloguj">Wyloguj: <?=$_SESSION['user']->imie?>  <?=$_SESSION['user']->nazwisko;?></a></li>
</ul>


<?php
}
?>
</nav>

<div id="content">


<?php
$src = "pages/" . $id . ".php";
if (file_exists($src))
	include($src);
else
	echo "Nie odnaleziono strony";

?>

</div>

</body>
</html>


<?php

$mysqli->close();

?>


