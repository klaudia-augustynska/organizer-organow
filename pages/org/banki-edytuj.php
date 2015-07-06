<article>

	<h1><i>Banki:</i> Edytuj bank</h1>


<?php

include("src/panstwa.php");

if (isset($_POST['edytujbank']) && isset($_GET['co'])) {
	if (Banki::Update( $_GET['co'], $_POST['nazwa'], $_POST['ulica'], $_POST['numer'], $_POST['miasto'], $_POST['panstwo'] ) == 0);
		print "Pomyślnie zaktualizowano";
}

$b = Banki::Get( $_GET['co'] );

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<label for="nazwa">
					Nazwa banku:
				</label>
					<input type="text" name="nazwa" id="nazwa" value="<?=$b['nazwa'];?>" />
			</div>
		
			<div>
				<label for="ulica">
					Ulica:
				</label>
					<input type="text" name="ulica" id="ulica" value="<?=$b['ulica'];?>" />
					<input type="text" name="numer" id="numer"  value="<?=$b['numer'];?>" />
			</div>
			
			<div>
				<label for="miasto">
					Miasto:
				</label>
					<input type="text" name="miasto" id="miasto" value="<?=$b['miasto'];?>" />
			</div>
			
			<div>
				<label for="panstwo">
					Państwo:
				</label>
					<select name="panstwo" id="panstwo">
					<?php
						$panstwa = Panstwa::GetAll();
						foreach ($panstwa as $p) {
							print '<option value="' . $p['id'] . '"';
							if (strcmp($b['panstwo_id'], $p['id']) == 0)
								print " selected";
							print '>' . $p['panstwo'] . '</option>';
						}
					?>
					</select>
			</div>
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="edytujbank" value="Edytuj bank" />
		</div>
	
	</form>

</article>