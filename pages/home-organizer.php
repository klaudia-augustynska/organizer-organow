<?php

if (!zalogowany()) {
	print "Odmowa dostępu";
	exit();
}

include_once("src/menu.php");

?>

<div class="column1">

<?php

if (isset($_GET['org']))
	$org = $_GET['org'];
else
	$org = "banki";

$src = "pages/org/" . $org . ".php";
if (file_exists($src))
	include($src);
else
	echo "Nie odnaleziono strony";
?>

</div>

<div class="column2">

<aside>

<nav>

<ul class="menu3">

<?php

	Menu::Generuj($_SESSION['id'], 1);

?>

</ul>

<!--
<ul class="menu3">
	<li>Banki
		<ul>
			<li><a href="?org=banki&amp;metoda=dodaj">Dodaj bank</a></li>
			<li><a href="?org=banki">Lista banków</a></li>
		</ul>
	</li>
	<li>Donacje
		<ul>
			<li><a href="?org=donacje&amp;metoda=dodaj">Dodaj donację</a></li>
			<li><a href="?org=donacje">Lista donacji</a></li>
		</ul>
	</li>
	<li>Dawcy
		<ul>
			<li><a href="?org=dawcy&amp;metoda=dodaj">Zarejestruj dawcę</a></li>
			<li><a href="?org=dawcy">Lista dawców</a></li>
		</ul>
	</li>
	<li>Pracownicy
		<ul>
			<li><a href="?org=pracownicy&amp;metoda=dodaj">Dodaj pracownika</a></li>
			<li><a href="?org=pracownicy">Lista pracowników</a></li>
		</ul>
	</li>
</ul>
-->
</nav>

</aside>

</div>