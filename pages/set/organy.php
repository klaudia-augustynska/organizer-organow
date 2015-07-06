	<article>
		
		<h1>Organy</h1>

<?php

include_once("src/organy.php");

if (isset($_POST['dodaj'])) {
    	if (Organy::Dodaj($_POST['nazwa'], $_POST['cena']) == 0)
		print "dodano organ";
}

else if (isset($_GET['metoda']) && $_GET['metoda'] == "usun"
  &&isset($_GET['ktory']))
        switch (Organy::Usun($_GET['ktory'])) {
            case 0:
		print "usunięto organ"; break;
            case -1:
                print "coś oszukujesz, nie ma takiego organu"; break;
            default:
                print "jakiś błąd"; break;
        }


$organy = Organy::GetAll();
	

?>
<form action="" method="post" class="blank">
		<table>
			<thead>
				<tr>
					<td class="id">Id</td>
					<td>Organ</td>
					<td>Cena za szt.</td>
					<td>Ilość</td>
					<td>Opcje</td>
				</tr>
			</thead>

			<tbody>
                                <tr class="nohover">
                                    <td></td>
                                    <td><input type="text" name="nazwa" /></td>
                                    <td><span class="nowrap"><input type="text" name="cena" /> zł</span></td>
									<td></td>
                                    <td>
                                        <input type="submit" name="dodaj" value="Dodaj organ" /></td>
                                </tr>          
                            
                            
<?php
	foreach ($organy as $g) {
?>

				<tr>
										<td><?=$g['id']?></td>
                                        <td><?=$g['nazwa']?></td>
										<td><?=$g['cena']?> zł</td>
										<td><?=$g['ilosc']?></td>
                                        <td>
										<a class="usun" href="?id=ustawienia&amp;set=organy&amp;ktory=<?=$g['id']?>&amp;metoda=usun">usuń</a></td>
				</tr>
	
<?php
	}
?>


                                
			</tbody>
                        
     
		</table>
		</form>
		
	