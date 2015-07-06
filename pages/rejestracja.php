<article>

	<h1>Rejestracja</h1>


<?php

include_once("src/uzytkownicy.php");

if (isset($_POST['rejestruj'])) {
	if (!Uzytkownicy::Dodaj( $_POST['email'], $_POST['passwd'], $_POST['imie'], $_POST['nazwisko'], $_POST['pesel'] ))
		print "Pomyślnie zarejestrowano";
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
					<input type="password" name="passwd" id="passwd" placeholder="********" />
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
		
		<div class="button">
		<input type="submit" name="rejestruj" value="Zarejestruj mnie" />
		</div>
	
	</form>
<?php
}
?>

</article>