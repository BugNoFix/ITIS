<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/Menubar.css">
    <link rel="stylesheet" type="text/css" href="css/LR.css">

	<title>Login & Register</title>
</head>
<body>
	<?php 
		// Se l'utente loggato entra in questa pagina va su index
		session_start();
    	if (isset($_SESSION['start_time'])){
    		header("location: index.php");
    	}

    	/*CONTROLLI*/
	 	$pass = false;
	 	$utente = false;
		// Login
		if(isset($_POST['log'])){
			//Setto le variabili
			$email = $_POST['Email2'];
			$password = $_POST['Password2'];

			// Connetto al DBMS
			$connessione = new mysqli("localhost", "root", "", "elaborato");
			// Controllo se l'utente esiste
			$query = "SELECT * FROM utente WHERE email = '$email'";
			$risultati = $connessione->query($query);

			// L'utente non è registrato
			if ($risultati->num_rows == 0)
				$utente = true;
			// L'utente è registrato
			else{
				// Prendo i dati dalla query
				$dataDBMS = $risultati->fetch_array();
				// Cifro la password
				$password = crypt($password, 10);
				// Controllo la pass
				if ($dataDBMS['Password'] == $password){ 
					// Distruzione eventuale sessione precedente
	                session_unset();
	                session_destroy();
	                // Inizializzazione nuova sessione
	                session_start();
	                $_SESSION['Nome'] = $dataDBMS['Nome'];
	                $_SESSION['Cognome'] = $dataDBMS['Cognome'];
	                $_SESSION['email'] = $email;
	                $_SESSION['start_time'] = time();
	                header("location: index.php");
				}
				else
					$pass = true;
			}
			$risultati->free();
			$connessione->close();
		}

		// Registrazione
		$utente_r = false;
		$regi = false;
		if(isset($_POST['reg'])){
			// Setto le variabili
			$nome = $_POST['Nome'];
			$cognome = $_POST['Cognome'];
			$email = $_POST['Email'];
			$password = $_POST['Password'];
			$cf = $_POST['CF'];
			$birthday = $_POST['Birthday'];

			// Connessione al DBMS
			$connection = new mysqli("localhost", "root", "", "elaborato");
			// Controllo se già questo iscritto è presente
			$query = "SELECT * FROM utente WHERE CodiceFiscale = '$cf' or email = '$email'";
			$risultato = $connection->query($query);
			// Controllo se la query ha dato risultati
			if (!$risultato) {
    			trigger_error('Invalid query: ' . $connection->error);
			}
			if($risultato->num_rows != 0)
				$utente_r = true;
			else{
				//Cript la password
				$password = crypt($password, 10);
				// Inserisco l'utente nel database
				$query = "INSERT INTO utente (CodiceFiscale, Nome, Cognome, Email, Password, DataNascita) VALUES ('$cf', '$nome', '$cognome', '$email', '$password', '$birthday')";
				$connection->query($query);
				$regi = true;
			}
			$connection->close();
		}
	?>

	<!-- Menu -->
	<header id = "navbar" class="navbar1">
	    <a class="logo" href="index.php"><img src="img\MenuBar\Logo.png" alt="logo" style="width: 30%; height: auto;"></a>
	    <nav>
	        <ul class="nav__links">
	            <li><a href="Index.php">Homepage</a></li>
	            <li><a href="Products.php">Prodotti</a></li>
	            <li><a href="Faq.php">FAQ</a></li>
	        </ul>
	    </nav>
	    <a class="cta" href="LoginRegister.php?x=1">Login</a>
	    <a class="cta" href="LoginRegister.php?x=2">Registrazione</a>
	</header>

	<!-- LOGIN REGISTER -->
	<div class="container" id="container">
		<div class="form-container sign-up-container">
			
			<!-- Registrazione -->
			<form action="LoginRegister.php?x=2" method="POST">
				<h1>Crea il tuo account</h1><br>
				<input required type="text" placeholder="Nome" name="Nome" style="text-transform:lowercase"/>
				<input required type="text" placeholder="Cognome" name="Cognome" style="text-transform:lowercase"/>
				<input required type="email" placeholder="Email" name="Email" style="text-transform:lowercase" />
				<input required type="password" placeholder="Password" name="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}"  oninvalid="this.setCustomValidity('La tua password deve contenere almeno 6 caratteri e contenere almeno una maiuscola, una minuscola e un numero.')"
	  oninput="this.setCustomValidity('')" style="text-transform:lowercase"/> <!-- oninput serve a non far vedere il messaggio durante la modifica del campo-->
				<input required type="text" placeholder="Codice Fiscale" name="CF" pattern="^([A-Za-z]{6}[0-9]{2}[A-Za-z][0-9]{2}[A-Za-z][0-9]{3}[A-Za-z]$)" oninvalid="this.setCustomValidity('il codice fiscale non e\' valido.')" oninput="this.setCustomValidity('')" style="text-transform:uppercase"/>
				<input required type="date" placeholder="Data di nascita" name="Birthday" style="text-transform:lowercase"/>
				<div class="error"><?php if($utente_r){echo"Utente gia registrato";} ?></div>
				<div class="correct"><?php if ($regi) {echo"Utente registrato";} ?></div>
				<button name="reg">Registrazione</button>
			</form>
		</div>
		<div class="form-container sign-in-container">
			
			<!-- Login -->
			<form action="LoginRegister.php?x=1" method="POST">
				<h1>Login</h1><br>
				<input required type="email" placeholder="Email" name="Email2" style="text-transform:lowercase">
				<input required type="password" placeholder="Password" name="Password2" style="text-transform:lowercase"/>
				<div class="error"><?php if($utente){echo"Utente non registrato";} elseif ($pass) {echo"Password Errata";} ?></div>
				<button name="log">Login</button>
			</form>
		</div>
		<div class="overlay-container">
			<div class="overlay">
				<div class="overlay-panel overlay-left">
					<h1>Bentornato!</h1>
					<p>Se hai gia un account entra con le tue credenziali</p>
					<button class="ghost" id="signIn">Login</button>
				</div>
				<div class="overlay-panel overlay-right">
					<h1>Ciao, amico!</h1>
					<p>Registrati e inserisci i tuoi dati per acqusitare i nostri prodotti</p>
					<button class="ghost" id="signUp">Registrazione</button>
				</div>
			</div>
		</div>
	</div>

	<script src="Script/LR.js"></script>
	
</body>
</html>