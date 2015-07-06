<div class="column1">

<?php

if (isset($_GET['set']))
	$set = $_GET['set'];
else
	$set = "organy";

$src = "pages/set/" . $set . ".php";
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
	<li>Profil
		<ul>
			<li><a href="?id=ustawienia&amp;set=profil">Edytuj profil</a></li>
			<li><a href="?id=ustawienia&amp;set=haslo">Zmień hasło</a></li>
		</ul>
	</li>
	<li>System
		<ul>
			<li><a href="?id=ustawienia&amp;set=organy">Organy</a></li>
			<li><a href="?id=ustawienia&amp;set=grupy">Grupy krwi</a></li>
			<li><a href="?id=ustawienia&amp;set=panstwa">Państwa</a></li>
			<li><a href="?id=ustawienia&amp;set=role">Role</a></li>
			<li><a href="?id=ustawienia&amp;set=stanowiska">Stanowiska</a></li>
		</ul>
	</li>
</ul>

</nav>

</aside>

</div>