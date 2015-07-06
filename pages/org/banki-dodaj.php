<article>

	<h1><i>Banki:</i> Dodaj bank</h1>


<?php

include("src/panstwa.php");

if (isset($_POST['dodajbank'])) {
	if (!(Banki::Dodaj( $_POST['nazwa'], $_POST['ulica'], $_POST['numer'], $_POST['miasto'], $_POST['panstwo'] )));
		print "Pomyślnie dodano";
}

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<label for="nazwa">
					Nazwa banku:
				</label>
					<input type="text" name="nazwa" id="nazwa" placeholder="Jakiś Bank" />
			</div>
		
			<div>
				<label for="ulica">
					Ulica:
				</label>
					<input type="text" name="ulica" id="ulica" placeholder="Wiejska" />
					<input type="text" name="numer" id="numer" placeholder="10" />
			</div>
			
			<div>
				<label for="miasto">
					Miasto:
				</label>
					<input type="text" name="miasto" id="miasto" placeholder="Bydgoszcz" />
			</div>
			
			<div>
				<label for="panstwo">
					Państwo:
				</label>
					<select name="panstwo" id="panstwo">
					<?php
						$panstwa = Panstwa::GetAll();
						foreach ($panstwa as $p)
							print '<option value="' . $p['id'] . '">' . $p['panstwo'] . '</option>';
					?>
					</select>
				</label>
			</div>
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="dodajbank" value="Dodaj bank" />
		</div>
	
	</form>

</article>