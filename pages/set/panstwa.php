	<article>
		
		<h1>Państwa</h1>

<?php

include_once("src/panstwa.php");

if (isset($_POST['dodaj'])) {
    	if (Panstwa::Dodaj($_POST['panstwo']) == 0)
		print "dodano państwo";
}

else if (isset($_GET['metoda']) && $_GET['metoda'] == "usun"
  &&isset($_GET['ktore']))
        switch (Panstwa::Usun($_GET['ktore'])) {
            case 0:
		print "usunięto państwo"; break;
            case -1:
                print "coś oszukujesz, nie ma takiego państwa"; break;
            default:
                print "jakiś błąd"; break;
        }


$panstwa = Panstwa::GetAll();
	

?>
<form action="" method="post" class="blank">
		<table>
			<thead>
				<tr>
					<td class="id">Id</td>
					<td colspan="2">Państwo</td>
				</tr>
			</thead>

			<tbody>
                                <tr class="nohover">
                                    <td></td>
                                    <td><input type="text" name="panstwo" /></td>
                                    <td>
                                        <input type="submit" name="dodaj" value="Dodaj państwo" /></td>
                                </tr>          
                            
                            
<?php
	foreach ($panstwa as $g) {
?>

				<tr>
					<td><?=$g['id']?></td>
                                        <td><?=$g['panstwo']?></td>
                                        <td><a  class="usun"  href="?id=ustawienia&amp;set=panstwa&amp;ktore=<?=$g['id']?>&amp;metoda=usun">usuń</a></td>
				</tr>
	
<?php
	}
?>


                                
			</tbody>
                        
     
		</table>
		</form>
		
	