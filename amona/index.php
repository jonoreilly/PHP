<?php

	$mysqli = new mysqli("localhost", "php", "php", "amona");
	if ($mysqli->connect_errno) 
	{ exit("Failed to connect to MySQL"); }


	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		if (!($sentencia = $mysqli->prepare("INSERT INTO mensajes (mensaje) VALUES (?)"))) 
		{ echo "Fallo la preparacion: (".$mysqli->errno.") ".$mysqli->error; }

		else if (!$sentencia->bind_param("s", $_POST["mensaje"])) 
		{ echo "Fallo la vinculacion de parametros: (".$sentencia->errno.") ".$sentencia->error; }

		else if (!$sentencia->execute()) 
		{ echo "Fallo la ejecucion: (".$sentencia->errno.") ".$sentencia->error; }

		$sentencia->close();
		$mysqli->commit();	
	}
	$res = $mysqli->query("SELECT mensaje FROM mensajes WHERE leido = FALSE;");

?>


<head>

	<link rel="stylesheet" type="text/css" href="css/index.css">

</head>

<body>

	<ul>
		<?php foreach ($res as $linea) { echo "<li>".$linea["mensaje"]."</li>"; } ?>
	</ul>

	<br>

	<form action="" method="post" accept-charset="utf-8">
		<input type="text" name="mensaje" placeholder="Mensaje pa la amona" maxlength="20">
		<input type="submit" value="ENVIAR">
	</form>

</body>

<?php $mysqli->close(); ?>