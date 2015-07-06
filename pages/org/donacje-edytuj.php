<article>

	<h1><i>Donacje:</i> Edytuj donację</h1>


<?php

include_once("src/donacje.php");
include_once("src/banki.php");
include_once("src/organy.php");

if (isset($_POST['edytujdonacje']) && isset($_GET['co'])) {
	if (Donacje::Update( $_GET['co'], $_POST['bank']) == 0);
		print "Pomyślnie zaktualizowano";
}

$b = Donacje::Get( $_GET['co'] );

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		
			<div>
				<span class="label">
					Organ:
				</span>
				<div class="podglad"><?=$b['organ']?></div>
			</div>
			<div>
				<span class="label">
					Dawca:
				</span>
				<div class="podglad"><?=$b['imie']?> <?=$b['nazwisko']?> (<?=$b['grupa']?> Rh<?=($b['rh'] == 1 ? "+" : "&ndash;")?>)</div>
			</div>
		
			<div>
				<label for="bank">
					Bank:
				</label>
					<select name="bank" id="bank">
						<option value="">[wybierz]</option>
					<?php
						$banki = Banki::GetAll();
						foreach ($banki as $p) {
							print '<option value="' . $p['id'] . '"';
							if (strcmp($b['bank_id'], $p['id']) == 0)
								print " selected";
							print '>' . $p['nazwa'] . '</option>';
						}
					?>
					</select>
			</div>
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="edytujdonacje" value="Aktualizuj donację" />
		</div>
	
	</form>

</article>