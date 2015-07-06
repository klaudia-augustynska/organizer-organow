<article>

	<h1><i>Użytkownicy:</i> Zmień hasło</h1>


<?php

include_once("src/uzytkownicy.php");
if (isset($_POST['edytujuzytkownika'])) {
	if (isset($_POST['haslo-stare']) && Uzytkownicy::HasloOK($id, $_POST['haslo-stare']) == 0) {
		if (
			Uzytkownicy::UpdateHaslo( 
			$_SESSION['id'], 
			$_POST['haslo-nowe']
		) == 0);
			print "Pomyślnie zaktualizowano";
	}
	else
		print "Było złe stare hasło";
} 
?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<label for="haslo-stare">
					Stare hasło:
				</label>
					<input type="password" name="haslo-stare" id="haslo-stare" />
			</div>
			<div>
				<label for="haslo-nowe">
					Nowe hasło:
				</label>
					<input type="password" name="haslo-nowe" id="haslo-nowe" />
			</div>
			
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="edytujuzytkownika" value="Zmień hasło" />
		</div>
	
	</form>

</article>