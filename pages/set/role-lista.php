	<article>
		
		<h1>Role</h1>

<?php
if (isset($_POST['dodaj'])) {
    	if (Role::Dodaj($_POST['nazwa']) == 0)
		print "dodano rolę, teraz wybierz opcje";
}

	$role = Role::GetAll();
	

?>
                <form action="" method="post" class="blank">
		<table>
			<thead>
				<tr>
					<td class="id">Id</td>
					<td>Nazwa</td>
					<td></td>
				</tr>
			</thead>
			
			<tbody>
                                                                <td></td>
                                    <td><input type="text" name="nazwa" /></td>
                                    <td>
                                        <input type="submit" name="dodaj" value="Dodaj rolę" /></td>
                                </tr> 
<?php
	foreach ($role as $r) {
?>

				<tr>
					<td><?=$r['id']?></td>
					<td><?=$r['nazwa']?></td>
					<td><a href="?id=ustawienia&amp;set=role&amp;metoda=opcje&amp;co=<?=$r['id']?>">dostępne opcje</a></td>
				
				</tr>
	
<?php
	}
?>

			</tbody>
		</table>
                    </form>
	
		
	