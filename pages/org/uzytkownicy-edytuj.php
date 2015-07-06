<article>

	<h1><i>Użytkownicy:</i> Zmień dane</h1>


<?php

include_once("src/uzytkownicy.php");
include_once("src/organy.php");
include_once("src/grupy.php");
include_once("src/panstwa.php");
include_once("src/role.php");
include_once("src/stanowiska.php");


if (isset($_GET['co']))
	$co = $_GET['co'];
else
	$co = $_SESSION['id'];

if (isset($_POST['stanowiska']))
	$stanowiska = $_POST['stanowiska'];
else
	$stanowiska = null;
	
if (isset($_POST['role']))
	$role = $_POST['role'];
else
	$role = null;

if (isset($_POST['edytujuzytkownika'])) {
	if (
		Uzytkownicy::Update( 
		$co, 
		$_POST['email'],
		$_POST['imie'],
		
		$_POST['nazwisko'],
		$_POST['pesel'],
		$_POST['grupa'],
		
		$stanowiska,
		$_POST['ulica'],
		$_POST['numer'],
		
		$_POST['miasto'],
		$_POST['panstwo'],
		$role
	) == 0);
		print "Pomyślnie zaktualizowano";
}

	
$b = Uzytkownicy::Get( $co );
$br = Uzytkownicy::GetRole( $co );
$bs = Uzytkownicy::GetStanowiska( $co );

?>
	
	
	<form method="post" action="" class="form">
	
		<fieldset>
		<legend>Dane do logowania</legend>
		
			<div>
				<label for="nazwa">
					Adres e-mail:
				</label>
					<input type="email" name="email" id="email" value="<?=$b['email']?>" />
			</div>
			
		
		</fieldset>
		<fieldset>
		<legend>Dane osobowe</legend>
		
			<div>
				<label for="imie">
					Imię:
				</label>
					<input type="text" name="imie" id="imie" value="<?=$b['imie']?>" />
			</div>
		
			<div>
				<label for="nazwisko">
					Nazwisko:
				</label>
					<input type="text" name="nazwisko" id="nazwisko" value="<?=$b['nazwisko']?>" />
			</div>
		
			<div>
				<label for="pesel">
					PESEL:
				</label>
					<input type="text" name="pesel" id="pesel" value="<?=$b['pesel']?>" />
			</div>
		
			<div>
				<label for="grupa">
					Grupa krwi:
				</label>
					<select name="grupa" id="grupa">
					
					<option> </option>
					<?php
						$grupy = Grupy::GetAll();
						foreach ($grupy as $o) {
							print '<option value="' . $o['id'] . '"';
							if ($b['grupa_id'] == $o['id']) print " selected";
							print '>' . $o['grupa'] . ($o['rh'] == 1 ? "+" : "&ndash;") . '</option>';
						}
					?>
					</select>
			</div>
			
		</fieldset>
		<fieldset>
		<legend>Stanowisko</legend>
		
		<?php
			$stanowiska = Stanowiska::GetAll();			
			foreach($stanowiska as $r) {
				print '<label><input type="checkbox" name="stanowiska[]" value="' . $r['id'] .'" ';
				if ($bs != NULL && in_array($r['id'],$bs)) print "checked ";
				print '/>' . $r['nazwa'] . '</label><br/>';
			}
		?>
			
		</fieldset>
		<fieldset>
		<legend>Adres</legend>
			
		

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
					<option> </option>
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
		
		
		
		<fieldset>
		<legend>Role</legend>
		<?php
			$role = Role::GetAll();			
			foreach($role as $r) {
				print '<label><input type="checkbox" name="role[]" value="' . $r['id'] .'" ';
				if ($br != NULL && in_array($r['id'], $br)) print "checked";
				print '/>' . $r['nazwa'] . '</label><br/>';
			}
		?>
		
		
		</fieldset>
		
		<div class="button">
		<input type="submit" name="edytujuzytkownika" value="Zmień dane użytkownika" />
		</div>
	
	</form>

</article>