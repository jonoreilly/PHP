<?php

	$mysqli = new mysqli("localhost", "php", "php", "amona");
	if ($mysqli->connect_errno) 
	{ echo "Failed to connect to MySQL"; }

	$res = $mysqli->query("SELECT mensaje FROM mensajes WHERE leido = FALSE;");

?>


<?php $mysqli->close(); ?>