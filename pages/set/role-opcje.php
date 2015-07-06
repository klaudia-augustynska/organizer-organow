	<article>
		
		<h1><i>Role:</i> Opcje</h1>

<?php

include_once("src/opcje.php");

/*
if (isset($_POST['dodaj'])) {
	if (Opcje::Dodaj($_POST['nazwa']) == 0)
		print "dodano opcję";
}
*/
if (isset($_POST['zmien'])) {
	if (Opcje::Update($_GET['co'], $_POST['opcja']) == 0)
		print "zmieniono opcje";
}

	$opcje = Opcje::GetAll();
	$rola = Role::Get($_GET['co']);
        $opcjeDlaRoli = Opcje::GetForId($_GET['co']);
	
?>


<h2>Opcje przypisane dla roli: "<?=$rola['nazwa']?>"</h2>	

<form action="" method="post" class="blank">
<table>
<tbody>
<!--
<tr>
	<td></td>
	<td></td>
	<td><input type="text" name="nazwa" /> <input type="submit" name="dodaj" value="Dodaj" /></td>
</tr>
-->
<?php
if (count($opcje) > 0)
foreach ($opcje as $o) {
?>

	<tr>
		<td><input type="checkbox" name="opcja[]" value="<?=$o['id']?>" <?php 
		
                    if ($opcjeDlaRoli != NULL && in_array($o['id'], $opcjeDlaRoli)) {
                        print " checked";
                    }
		
		?>/></td>
		<td><?=$o['id']?></td>
		<td><?=$o['nazwa']?></td>
	</tr>

<?php
}
?>

</tbody>

<tfoot>
<tr>
<td></td><td></td><td><input type="submit" name="zmien" value="Zmień opcje" class="submit"/>

</tfoot>
</table>
</form>
	
		
	</article>