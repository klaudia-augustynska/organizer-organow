	<article>
		
		<h1>Grupy krwi</h1>

<?php

include_once("src/grupy.php");

if (isset($_POST['dodaj'])) {
    	if (Grupy::Dodaj($_POST['literka'], $_POST['rh']) == 0)
		print "dodano grupę krwi";
}

if (isset($_GET['metoda']) && $_GET['metoda'] == "usun"
  &&isset($_GET['ktora']))
        switch (Grupy::Usun($_GET['ktora'])) {
            case 0:
		print "usunięto grupę krwi"; break;
            case -1:
                print "coś oszukujesz, takiej grupy nie ma"; break;
            default:
                print "jakiś błąd"; break;
        }


$grupy = Grupy::GetAll();
	

?>
<form action="" method="post" class="blank">
		<table>
			<thead>
				<tr>
					<td class="id">Id</td>
					<td>Literka</td>
					<td colspan="2">Rh</td>
				</tr>
			</thead>

			<tbody>
                                <tr class="nohover">
                                    <td></td>
                                    <td><input type="text" name="literka" /></td>
                                    <td><input type="radio" name="rh" value="1" checked /> + / 
                                        <input type="radio" name="rh" value="0" /> &ndash;</td>
                                    <td>
                                        <input type="submit" name="dodaj" value="Dodaj nową grupę" /></td>
                                </tr>          
                            
                            
<?php
	foreach ($grupy as $g) {
?>

				<tr>
					<td><?=$g['id']?></td>
                                        <td><?=$g['grupa']?></td>
                                        <td>Rh<?=($g['rh'] == 1 ? "+" : "&ndash;")?></td>
                                        <td><a  class="usun" href="?id=ustawienia&amp;set=grupy&amp;ktora=<?=$g['id']?>&amp;metoda=usun">usuń</a></td>
				</tr>
	
<?php
	}
?>


                                
			</tbody>
                        
     
		</table>
		</form>
		
	