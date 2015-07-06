	<article>
		
		<h1>Donacje</h1>

<?php

include_once("src/donacje.php");
	
	if (isset($_GET['metoda']) && isset($_GET['co']) && strcmp($_GET['metoda'], "usun") == 0)
		if (!(Donacje::Usun($_GET['co'])))
			print "Usunięto donację";
		else
			print "Blad";
			
			
	$tablica = Donacje::GetAll();
	

if (count($tablica) > 0) {
?>

		<table>
			<thead>
				<tr>
					<td>Data</td>
					<td>Organ</td>
					<td>Bank</td>
					<td>Dawca</td>
					<td>Operacje</td>
				</tr>
			</thead>
			
			<tbody>
<?php
	foreach ($tablica as $t) {
?>

				<tr>
					<td><span class="nowrap"><?=$t['data']?></span></td>
					<td><?=$t['organ']?></td>
					<td><?php 
						if ($t['bank'] == NULL) print "-";
						else print $t['bank'];
					?></td>
					<td><?=$t['imie']?> <?=$t['nazwisko']?></td>
					<td><a href="?org=donacje&metoda=edytuj&co=<?=$t['id']?>">edytuj</a>, <a href="?org=donacje&metoda=usun&co=<?=$t['id']?>">usuń</a></td>
				
				</tr>
	
<?php
	}
?>

			</tbody>
		</table>

<?php
}
?>		
		
	