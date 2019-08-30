<?php

	$mysqli = new mysqli("localhost", "php", "php", "amona");
	if ($mysqli->connect_errno) 
	{ echo "Failed to connect to MySQL"; }


	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (!($sentencia = $mysqli->prepare("UPDATE mensajes WHERE id = (?) SET leido = TRUE"))) 
		{ echo "Fallo la preparacion: (".$mysqli->errno.") ".$mysqli->error; }

		else if (!$sentencia->bind_param("i", $_POST["id"])) 
		{ echo "Fallo la vinculacion de parametros: (".$sentencia->errno.") ".$sentencia->error; }

		else if (!$sentencia->execute()) 
		{ echo "Fallo la ejecucion: (".$sentencia->errno.") ".$sentencia->error; }

		$sentencia->close();
        $mysqli->commit();
        echo "Done";
    }
    else
    {
        echo "Nothing done";
    }
?>


<?php $mysqli->close(); ?>