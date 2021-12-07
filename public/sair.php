<?php
	session_start();
	unset($_SESSION["Id_usuario"]);
	unset($_SESSION["Nome"]);
	unset($_SESSION["Usuario"]);
	header("location: index.php");
?>