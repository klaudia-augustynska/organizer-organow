<?php

if ($_SESSION['id'] > 0) {
	session_destroy();
	header("Location: $home?id=logowanie");
	exit();
}