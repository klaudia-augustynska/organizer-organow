	<article>
		
		<h1>Stanowiska</h1>

<?php

include_once("src/stanowiska.php");

if (isset($_POST['dodaj'])) {
    	if (Stanowiska::Dodaj($_POST['nazwa'], $_POST['pensja']) == 0)
		print "dodano stanowisko";
}

else if (isset($_GET['metoda']) && $_GET['metoda'] == "usun"
  &&isset($_GET['ktore']))
        switch (Stanowiska::Usun($_GET['ktore'])) {
            case 0:
		print "usunięto stanowisko"; break;
            case -1:
                print "coś oszukujesz, nie ma takiego stanowiska"; break;
            default:
                print "jakiś błąd"; break;
        }


$stanowiska = Stanowiska::GetAll();
	

?>
<form action="" method="post" class="blank">
		<table>
			<thead>
				<tr>
					<td class="id">Id</td>
					<td colspan="2">Stanowisko</td>
				</tr>
			</thead>

			<tbody>
                                <tr class="nohover">
                                    <td></td>
                                    <td><input type="text" name="nazwa" /></td>
                                    <td><span class="nowrap"><input type="number" name="pensja" min="1680" step="1" value="1680" /> zł</span></td>
                                    <td>
                                        <input type="submit" name="dodaj" value="Dodaj stanowisko" /></td>
                                </tr>          
                            
                            
<?php
	foreach ($stanowiska as $g) {
?>

				<tr>
					<td><?=$g['id']?></td>
                                        <td><?=$g['nazwa']?></td>
                                        <td><?=$g['pensja']?> zł</td>
                                        <td><a class="usun" href="?id=ustawienia&amp;set=stanowiska&amp;ktore=<?=$g['id']?>&amp;metoda=usun">usuń</a></td>
				</tr>
	
<?php
	}
?>


                                
			</tbody>
                        
     
		</table>
		</form>
		
	