	<article>
		
		<h1>Dawcy</h1>

<?php

include_once("src/uzytkownicy.php");
	
	if (isset($_GET['metoda']) && isset($_GET['co']) && strcmp($_GET['metoda'], "usun") == 0)
		if (!(Uzytkownicy::Usun($_GET['co'])))
			print "Usunięto użytkownika";
		else
			print "Blad";
			
			
	$tablica = Uzytkownicy::GetAllDawcy();
	

if (count($tablica) > 0) {
?>

		<table>
			<thead>
				<tr>
					<td>Dawca</td>
					<td>E-mail</td>
					<td>PESEL</td>
					<td>Liczba donacji</td>
					<td>Operacje</td>
				</tr>
			</thead>
			
			<tbody>
<?php
	foreach ($tablica as $t) {
?>

				<tr>
					<td><?=$t['imie']?> <?=$t['nazwisko']?></td>
					<td><?=$t['email']?></td>
					<td><?=$t['pesel']?></td>
					<td><?=$t['donacji']?></td>
					<td><a href="?org=dawcy&metoda=edytuj&co=<?=$t['id']?>">edytuj</a><?php
					if ($t['donacji'] == 0) {
					?>, <a href="?org=dawcy&metoda=usun&co=<?=$t['id']?>">usuń</a></td>
					<?php }
					?>
				
				</tr>
	
<?php
	}
?>

			</tbody>
		</table>

<?php
}
?>		
		
	