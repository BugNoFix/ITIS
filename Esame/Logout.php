<?php
    // distruzione sessione corrente
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    $n = count($_COOKIE);
    for ($i=0; $i < $n; $i++) { 
    	$array = json_decode(array_shift($_COOKIE));
    	$idProduct = $array[4];
    	// Fix problem NaN cookie
    	if ($idProduct != "") {
 		   	echo $i."\n";
			echo "<script>document.cookie = $idProduct + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;'</script>";
    	}
    }
    echo "<script>window.location.href = \"index.php\";</script>";

?>