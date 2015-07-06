<article>

	<h1><i>Pracownicy:</i> Dodaj</h1>



<?php

include_once("src/uzytkownicy.php");
include_once("src/stanowiska.php");

if (isset($_POST['rejestruj'])) {
	if (isset($_POST['grupa']))
		$grupa = $_POST['grupa'];
	else
		$grupa = NULL;
		
	switch (Uzytkownicy::Dodaj( $_POST['email'], $_POST['pesel'], $_POST['imie'], $_POST['nazwisko'], $_POST['pesel'], $grupa )) {
		case -1:
			print "Mail już jest w bazie"; break;
		case 0:
			print "Pomyślnie zarejestrowano"; break;
		default:
			print "Jakiś błąd"; break;
	}
}
else {

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		<legend>Dane do logowania</legend>
		
			<div>
				<label for="nazwa">
					Adres e-mail:
				</label>
					<input type="email" name="email" id="email" placeholder="adres@mailowy.com" />
			</div>
		
			<div>
				<label for="ulica">
					Hasło:
				</label>
					<div class="podglad">nr PESEL</div>
			</div>
		
		</fieldset>
		
		<fieldset>
		<legend>Dane osobowe</legend>
		
			<div>
				<label for="imie">
					Imię:
				</label>
					<input type="text" name="imie" id="imie" placeholder="Paweł" />
			</div>
		
			<div>
				<label for="nazwisko">
					Nazwisko:
				</label>
					<input type="text" name="nazwisko" id="nazwisko" placeholder="Chojnacki" />
			</div>
		
			<div>
				<label for="pesel">
					PESEL:
				</label>
					<input type="text" name="pesel" id="pesel" placeholder="92121010569" />
			</div>
		
		</fieldset>
		
		<fieldset>
		<legend>Stanowiska</legend>
		<?php
			$stanowiska = Stanowiska::GetAll();			
			foreach($stanowiska as $r) {
				print '<label><input type="checkbox" name="role[]" value="' . $r['id'] .'" />' . $r['nazwa'] . '</label><br/>';
			}
		?>
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="rejestruj" value="Dodaj pracownika" />
		</div>
	
	</form>
<?php
}
?>

</article>