<article>

	<h1><i>Donacje:</i> Dodaj donację</h1>


<?php

include_once("src/donacje.php");
include_once("src/organy.php");

if (isset($_POST['dodajdonacje'])) {
	switch (Donacje::Dodaj( $_POST['organ'], $_POST['dawca'] )) {
	case -1: print "Nie ma takiego dawcy"; break;
	case 0: print "Pomyślnie dodano"; break;
	default: print "Wystapił błąd"; break;
	}
}

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<label for="organ">
					Organ:
				</label>
					<select name="organ" id="organ">
					<?php
						$organy = Organy::GetAll();
						foreach ($organy as $o)
							print '<option value="' . $o['id'] . '">' . $o['nazwa'] . '</option>';
					?>
					</select>
			</div>
		
			<div>
				<label for="dawca">
					Dawca (id/email):
				</label>
					<input type="text" name="dawca" id="dawca" placeholder="k@laudia.pl" />
			</div>
			
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="dodajdonacje" value="Dodaj donację" />
		</div>
	
	</form>

</article>