	<article>
		
		<h1>Banki</h1>

<?php
	
	if (isset($_GET['metoda']) && isset($_GET['co']) && strcmp($_GET['metoda'], "usun") == 0)
		if (!(Banki::Usun($_GET['co'])))
			print "Usunięto bank";
		else
			print "Blad";
			
	$tablica = Banki::GetAll();
	

if (count($tablica) > 0) {
?>

		<table>
			<thead>
				<tr>
					<td>Nazwa</td>
					<td>Adres</td>
					<td>Organów</td>
					<td>Operacje</td>
				</tr>
			</thead>
			
			<tbody>
<?php
	foreach ($tablica as $t) {
?>

				<tr>
					<td><?=$t['nazwa']?></td>
					<td><?=$t['miasto'] . " (" . $t['panstwo'] . "), " . $t['ulica'] . " " . $t['numer']?></td>
					<td><?=$t['ilosc']?></td>
					<td><a href="?org=banki&metoda=edytuj&co=<?=$t['id']?>">edytuj</a>, <a href="?org=banki&metoda=usun&co=<?=$t['id']?>">usuń</a></td>
				
				</tr>
	
<?php
	}
?>

			</tbody>
		</table>

<?php
}
?>		
		
	