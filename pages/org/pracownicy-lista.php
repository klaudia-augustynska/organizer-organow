	<article>
		
		<h1>Pracownicy</h1>

<?php

include_once("src/uzytkownicy.php");
	
	if (isset($_GET['metoda']) && isset($_GET['co']) && strcmp($_GET['metoda'], "usun") == 0)
		if (!(Uzytkownicy::Usun($_GET['co'])))
			print "Usunięto użytkownika";
		else
			print "Blad";
			
			
	$tablica = Uzytkownicy::GetAllPracownicy();
	

if (count($tablica) > 0) {
?>

		<table>
			<thead>
				<tr>
					<td>Pracownik</td>
					<td>Stanowisko</td>
					<td>Ile zarabia</td>
					<td>Operacje</td>
				</tr>
			</thead>
			
			<tbody>
<?php
	foreach ($tablica as $t) {
?>

				<tr>
					<td><?=$t['imie']?> <?=$t['nazwisko']?></td>
					<td><?=$t['stanowiska']?></td>
					<td><?=$t['ile_zarabia']?> zł</td>
					<td><a href="?org=dawcy&metoda=edytuj&co=<?=$t['id']?>">edytuj</a>, <a href="?org=dawcy&metoda=usun&co=<?=$t['id']?>">usuń</a></td>
				
				</tr>
	
<?php
	}
?>

			</tbody>
		</table>

<?php
}
?>		
		
	