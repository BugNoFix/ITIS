<?php
	session_start();

	$nomefile="coordinate.doc";
	header ("Content-Type: application/vnd.ms-word");
	header ("Content-Disposition: inline; filename=$nomefile");

	$connection = new mysqli("localhost", "root", "", "googlemaps");
    $email = $_SESSION['email'];
	$query = "SELECT * FROM markers WHERE EmaiUtente = '$email'";
	$result = $connection->query($query);

	if ($result->num_rows == 0)
		echo "Non ci sono markers salvati";
	else{
		echo"<TABLE>";
		echo"<tr><td>Latitudine</td><td>Longitudine</td></tr>";
		while($array = $result->fetch_array()){
			echo"<tr><td>$array[Latitudine]</td><td>$array[Longitudine]</td></tr>";
		}
		echo"</TABLE>"; 
	}

?>