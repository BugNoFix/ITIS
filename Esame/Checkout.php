<!DOCTYPE html> 
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/MenuBar.css">
	<link rel="stylesheet" type="text/css" href="css/Checkout.css">
	<title>Checkout</title>
</head>
<body>

	<?php
		if(!isset($_SESSION)) { 
	        session_start(); 
	    } 
	    if (!isset($_SESSION['start_time'])) {
	        header('Location: LoginRegister.php');
	        die; // per essere sicuro di chiudere la connessione con la pagina
	    } else {
	        $now = time();
	        $time = $now - $_SESSION['start_time'];
	        if ($time > 3600) {
	            header('Location: logout.php');
	            die;
	        }
	    }
	?>
	<!-- Menu -->
    <header id = "navbar2" class="navbar1">
        <a class="logo" href="index.php"><img src="img\MenuBar\Logo.png" alt="logo" style="width: 30%; height: auto;"></a>
        <nav>
            <ul class="nav__links">
                <li><a href="Index.php">Homepage</a></li>
                <li><a href="Products.php">Prodotti</a></li>
                <li><a href="Faq.php">FAQ</a></li>
            </ul>
        </nav>
        <?php 
            if (!isset($_SESSION['start_time'])){
         ?>
        <a class="cta" href="LoginRegister.php?x=1">Login</a>
        <a class="cta" href="LoginRegister.php?x=2">Registrazione</a>
        <?php 
            }
            else{
        ?>
        <a class="cta" href="Logout.php">Logout</a>
        <?php } ?>
    </header>

	<center>
		<?php if (!isset($_POST['Avanti'])){ ?>
		<div class="top">
		<form method="POST" action="Checkout.php">
			<div class="checkout-panel">
				<div class="panel-body">
					<h2 class="title">Acquisto</h2>

					<div class="progress-bar">
						<div class="step active"></div>
						<div class="step active"></div>
						<div class="step"></div>
						<div class="step"></div>
					</div>
					<div class="input-fields">
						<div class="column-1" style="margin-right: 10px">
							<label for="cardholder">Nome</label>
							<input required type="text" id="cardholder"/>

							<div class="small-inputs">
								<div>
									<label for="date">Data</label>
									<input required type="text" name="date" maxlength='5'  onkeyup="formatString(event);"/>
								</div>

								<div>
									<label for="verification">CVV / CVC *</label>
									<input required type="text" name="verification" maxlength='3' minlength='3'onkeypress="OnlyNumber(event)"/>
								</div>
							</div>

							<label for="cardholder" >Indirizzo di spedizione</label>
							<input required type="text"  name="shipment" style=" margin-bottom: 10%;" />

						</div>
						<div class="column-2">
							<label for="cardnumber">Numero carta</label>
							<input required type="text" onkeypress="OnlyNumber(event)" id="cardnumber" name="cardnumber1" maxlength ="19" autocomplete="off"  pattern="[0-9]* [0-9]* [0-9]* [0-9]* " oninvalid="this.setCustomValidity('Numero di carta non valido')" oninput="this.setCustomValidity('')" style="text-transform:lowercase"/style="margin-left: 2%;" />

							<span class="info">* Il CVV è il codice di sicurezza posto dietro la carta.</span>
						</div>
					</div>
				</div>
			</div>
			<div class="panel-footer">
				<a href="Index.php"><button class="btn back-btn">Indietro</button></a>
				<a href=""><button class="btn next-btn" name="Avanti">Avanti</button></a>
			</div>
			<?php 
				if (isset($_POST['IdP'])) {
					$_SESSION["IdP"] = $_POST['IdP'];
				} 
			?>
		</form>
		</div>
	<?php } else{ 
				/*ORDINE*/
				$card = crypt(str_replace(" ", "",$_POST['cardnumber1']), 10);
				$ship = $_POST['shipment'];
				// Connetto al DMBS
		        $connection = new mysqli("localhost", "root", "", "elaborato");
		        $email = $_SESSION["email"];
				// Carico in tabella ordine
		        $query = "INSERT INTO `ordine` (`Id`, `NumeroCarta`, `IndirizzoSpedizione`, `Corriere`, `CodiceFiscaleUtente`) VALUES (NULL, '$card', '$ship', 'Brt', (SELECT CodiceFiscale FROM `utente` WHERE email = '$email'));";
		        $connection->query($query);

			    /*DETTAGLI ORDINE*/
		        // Get Id ordine
		        $query = "SELECT LAST_INSERT_ID()";
		        $risultati = $connection->query($query);
		        $tmp = $risultati->fetch_array();
		        $idOrdine = $tmp[0];

		        // Compra subito
				if(isset($_SESSION["IdP"])){
					$idProduct = $_SESSION["IdP"];
					$query = "INSERT INTO `dettaglioordine` (`Id`, `Quantita`, `IdProdotti`, `IdOrdine`) VALUES (NULL, '1', '$idProduct', '$idOrdine');";
			        $connection->query($query);
			        unset($_SESSION['IdP']);
				}
				// Acquisto piu prodotti
				else{
					$n = count($_COOKIE);
			        for ($i=0; $i < $n - 1; $i++) { 
			        	$array = json_decode(array_shift($_COOKIE));
			        	$idProduct = $array[4];
			        	$quantity = $array[5];
						// Fix problem NaN cookie
						if ($idProduct != "") {
				        	$query = "INSERT INTO `dettaglioordine` (`Id`, `Quantita`, `IdProdotti`, `IdOrdine`) VALUES (NULL, '$quantity', '$idProduct', '$idOrdine');";
				        	$connection->query($query);
							echo "<script>document.cookie = $idProduct + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;'</script>";
						}
			        } 
			    }
		        ?>
			<div class="checkout-panel">
				<div class="panel-body">
					<h2 class="title">Acquisto completato</h2>

					<div class="progress-bar">
						<div class="step active"></div>
						<div class="step active"></div>
						<div class="step active"></div>
						<div class="step"></div>
					</div>
					<label></label>
				<div class="input-fields">
					<label style="width: 764px; margin-bottom: 15%; margin-top: 10%;">Acquisto effettuato</label>

				
				</div>
			</div>

			<div class="panel-footer">
				<label class="btn back-btn" style="visibility: hidden;"></label>
				<a href="index.php"><button class="btn next-btn" name="Avanti">Torna allo store</button></a>
			</div>
		
		<?php
			}
		?>
		


 <!-- Space for credit card number -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

	// enable spacing for credit card number     
	$('#cardnumber').on('keypress change', function() {
		$(this).val(function(index, value) {
		return value.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
		});
	});

	function formatString(e) {
		var inputChar = String.fromCharCode(event.keyCode);
		var code = event.keyCode;
		var allowedKeys = [8];
		if (allowedKeys.indexOf(code) !== -1) {
		return;
		}

		event.target.value = event.target.value.replace(
		/^([1-9]\/|[2-9])$/g, '0$1/' // 3 > 03/
		).replace(
		/^(0[1-9]|1[0-2])$/g, '$1/' // 11 > 11/
		).replace(
		/^([0-1])([3-9])$/g, '0$1/$2' // 13 > 01/3
		).replace(
		/^(0?[1-9]|1[0-2])([0-9]{2})$/g, '$1/$2' // 141 > 01/41
		).replace(
		/^([0]+)\/|[0]+$/g, '0' // 0/ > 0 and 00 > 0
		).replace(
		/[^\d\/]|^[\/]*$/g, '' // To allow only digits and `/`
		).replace(
		/\/\//g, '/' // Prevent entering more than 1 `/`
		);
	}

	function OnlyNumber(evt) {
		var theEvent = evt || window.event;

		// Handle paste
		if (theEvent.type === 'paste') {
			key = event.clipboardData.getData('text/plain');
		} else {
			// Handle key press
			var key = theEvent.keyCode || theEvent.which;
			key = String.fromCharCode(key);
		}
		var regex = /[0-9]|\./;
		if( !regex.test(key) ) {
			theEvent.returnValue = false;
		if(theEvent.preventDefault) theEvent.preventDefault();
		}
	}
    
    function getCookie(cname) {
	    var name = cname + "=";
	    var decodedCookie = decodeURIComponent(document.cookie);
	    var ca = decodedCookie.split(';');
	    for(var i = 0; i <ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	}    

	
</script>

</body>
</html>