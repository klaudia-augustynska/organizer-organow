<article>

	<h1>Logowanie</h1>

<?php

include_once("src/uzytkownicy.php");

if (isset($_POST['zaloguj'])) {
	if ($id = Uzytkownicy::Uwierzytelnianie($_POST['email'], $_POST['haslo'])) {
		$_SESSION['id'] = $id;
		$_SESSION['user'] = new Uzytkownicy($id);
		header("Location: index.php");
		exit();
	} else
		print "Zły e-mail lub hasło";
}

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<label for="email">
					Adres e-mail:
				</label>
					<input type="email" name="email" id="email" placeholder="adres@mailowy.com" />
			</div>
		
			<div>
				<label for="haslo">
					Hasło:
				</label>
					<input type="password" name="haslo" id="haslo" placeholder="********" />
			</div>
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="zaloguj" value="Zaloguj" />
		</div>
	
	</form>

</article>