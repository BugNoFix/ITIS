<html>
<title>Maps</title>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<?php
		// Sessione
		if(!isset($_SESSION)) { 
	        session_start(); 
	    } 
	    if (!isset($_SESSION['start_time'])) {
	        header('Location: login.php?x=2');
	        die; // per essere sicuro di chiudere la connessione con la pagina
	    } else {
	        $now = time();
	        $time = $now - $_SESSION['start_time'];
	        if ($time > 3600) {
	            header('Location: logout.php');
	            die;
	        }
	    }

        // Setto variabili
	    $connection = new mysqli("localhost", "root", "", "googlemaps");
        $email = $_SESSION['email'];

	    // Aggiunta maker al dbms
	    if (isset($_POST['Invia'])){
	    	$img = $_POST['img'];
	    	$nome = $_POST['nome'];
	    	$desc = $_POST['desc'];
	    	$lat = $_POST['lat'];
	    	$lng = $_POST['lng'];
       	 	$query = "INSERT INTO `markers` (`img`, `titolo`, `Latitudine`, `descrizione`, `Longitudine`, `marker`, `EmaiUtente`) VALUES ('$img', '$nome', '$lat', '$desc', '$lng', NULL, '$email');";	
       	 	$connection->query($query);
        }

        //Eliminazione maker dbms
        if(isset($_POST['Elimina'])){
	    	$id = $_POST['id'];
        	$query = "DELETE FROM markers WHERE EmaiUtente = '$email' and marker = '$id'";	
       	 	$connection->query($query);
        }

        // Prendo tutti i maker dal dbms
        $query = "SELECT * FROM `markers` WHERE EmaiUtente = '$email'";
        $risultati = $connection->query($query);
        if ($risultati->num_rows == 0)
        	echo "<script type=\"text/javascript\">var markers = [];</script>";
        else{
        	echo "<script type=\"text/javascript\">var markers = [";
        	while ($utente = $risultati->fetch_array()) {
        		$lat = $utente['Latitudine'];
        		$lng = $utente['Longitudine'];
        		$titolo = $utente['titolo'];
        		$img = $utente['img'];
        		$desc = $utente['descrizione'];
        		$id = $utente['marker'];
        		echo "[\"$lat\", \"$lng\", \"$titolo\", \"$img\", \"$desc\", \"$id\"], ";
        	}
        	echo "];</script>";
        }

	?>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA8WTq4A6nuT2uOG94rtU419SZbh21Eg1k &sensor=true"></script> <!-- api di google maps -->

	<script>
		function CheckBox() {
			var checkBox = document.getElementById("myCheck");

			if (checkBox.checked == true){
				for (var i = mar.length - 1; i >= 0; i--) {
					mar[i].setVisible(false);
				}
			} 
			else {
				for (var i = mar.length - 1; i >= 0; i--) {
					mar[i].setVisible(true);
				}
			}
		}
		var lat='38.0222259';//<!--coordinate dell'istituto-->
		var lng='12.5251428';
		var coordinate = new google.maps.LatLng(lat,lng);
		var opzioni = {
			zoom: 17,
			center:coordinate,
			mapTypeControl: false, // rimosso bottone in alto a sinistra
			mapTypeId:google.maps.MapTypeId.ROADMAP
		}
		var mar=[];
		var mappa;
		var infowindow;
		var marker;
		function inizializza(){
			// Salva una posizione
			this.placeMarker = function placeMarker(img) {
				var location;
				// Evento click su mappa per salvare una posizione
				var listener1 = google.maps.event.addListener(mappa, 'click', function (event) {
					/*Questo codice viene eseguito dopo il click*/
					// Salvo la posizione dopo il click
			   		location = event.latLng;
			   		// Annullo il click
					google.maps.event.removeListener(listener1);
					// Setto l'immagine
					var image={
						url:img,
						scaledSize: new google.maps.Size(40, 40), // scaled size
				    	origin: new google.maps.Point(0,0), // origin
				    	anchor: new google.maps.Point(20, 40) // anchor

					};
					// Creo il marker
				    var marker = new google.maps.Marker({
				        position: location,
				        icon:image
				    });
				    marker.setMap(mappa);
				    
				    // Get location
				    var tmp = JSON.stringify(location);
				   	var lat = JSON.parse(tmp)["lat"];
				   	var lng = JSON.parse(tmp)["lng"];

				   var stringa="<center><form action=\"Index.php\" method=\"POST\"><input placeholder=\"Nome\" type=\"text\" name=\"nome\" class=\"nome\" required><br><input type=\"text\" placeholder=\"Descrizione\" name=\"desc\" class=\"desc\"><br><input type=\"submit\" class=\"but\" value=\"Salva\" name=\"Invia\"><input type = \"hidden\" name = \"lat\" value = \"" + lat + "\" /><input type = \"hidden\" name = \"lng\" value = \"" + lng + "\" /><input type = \"hidden\" name = \"img\" value = " + img + " /></form></center>"; //Ricarichera la pagina e sara il php ad aggiungere i marker
					var infowindow=new google.maps.InfoWindow({
						content: stringa,
						position:location
					});
					infowindow.open(mappa,marker);
					});
			}

			function addNewlines(str) {
				var result = '';
				while (str.length > 0) {
					result += str.substring(0, 40) + '<br>';
					str = str.substring(40);
				}

				return result;
				}

			function CreateMarker(name, pos, img, desc, id){
				// Setto img
				var image={
					url:img,
					scaledSize: new google.maps.Size(40, 40), // scaled size
			    	origin: new google.maps.Point(0,0), // origin
			    	anchor: new google.maps.Point(20, 40) // anchor
				};
				// Setta il marker
				var marker = new google.maps.Marker({
					title:name,
					map:mappa,
					icon:image,
					position:pos
				});
				
				mar.push(marker)

				// Inserisco il marker
				marker.setMap(mappa);

				// Setto infobox
				var stringa = "<form style=\"margin:10px 10px;\" action=\"Index.php\" method=\"POST\"><center style=\"margin-bottom: 6px;\"><label class=\"title\">" + marker.getTitle() +"</label></center>" + addNewlines(desc) + " <button class=\"but2\" name=\"Elimina\">Elimina</button><input type = \"hidden\" name = \"id\" value = \"" + id + "\" /><form>";
				var infowindow=new google.maps.InfoWindow({
						content: stringa,
						position:pos
					});

				// Evento click sul marker
				google.maps.event.addListener(marker,'click',function(){
					infowindow.open(mappa,marker);
				});
			}

			this.setMap = function setMap(type){
				if (type == 1)
					mappa.setMapTypeId(google.maps.MapTypeId.ROADMAP);
				else if (type == 2)
					mappa.setMapTypeId(google.maps.MapTypeId.SATELLITE);
				else if (type == 3)
					mappa.setMapTypeId(google.maps.MapTypeId.HYBRID);
				else if (type == 4)
					mappa.setMapTypeId(google.maps.MapTypeId.TERRAIN);
			}
			// Creo istanza mappa
			var mappa = new google.maps.Map(document.getElementById('mappa'),opzioni);

			// Creo i makers
			for (var i = markers.length - 1; i >= 0; i--) {
				pos = new google.maps.LatLng(markers[i][0], markers[i][1]);
				name = markers[i][2];
				img = markers[i][3];
				desc = markers[i][4];
				id = markers[i][5];
				CreateMarker(name, pos, img, desc, id)
			}
			
			// Ad ogn click mostra le cordinate
			google.maps.event.addListener(mappa,'click',function(event){
				document.getElementById('lat').value=event.latLng.lat();
				document.getElementById('lng').value=event.latLng.lng();
			});

		}
	</script>
</head>
<body ONLOAD="inizializza();" style="max-height: 100%;max-width: 100%;">
 	<link rel="stylesheet" type="text/css" href="css/Menubar.css">
	<script src="Script/Menubar.js"></script>

	<div id="mySidenav" class="sidenav">
		<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
		<!-- Aggiungi marker -->
		<center><label class="label">Aggiungi marker</label></center>
		<div class="marker">
			<button style="margin-left: 25px;" onclick="closeNav();placeMarker('img/Marker/Marker.png');">
    			<img src="img/Marker/Marker.png" width="50" height="50" />
			</button>
			<button onclick="closeNav();placeMarker('img/Marker/Marker2.png')">
    			<img src="img/Marker/Marker2.png" width="50" height="50" />
			</button>
			<button onclick="closeNav();placeMarker('img/Marker/Marker3.png')">
    			<img src="img/Marker/Marker3.png" width="50" height="50" />
			</button>
			<br>
			<button style="margin-left: 25px;" onclick="closeNav();placeMarker('img/Marker/Marker4.png')">
    			<img src="img/Marker/Marker4.png" width="50" height="50" />
			</button>
			<button onclick="closeNav();placeMarker('img/Marker/Marker5.png')">
    			<img src="img/Marker/Marker5.png" width="50" height="50" />
			</button>
			<button onclick="closeNav();placeMarker('img/Marker/Marker6.png')">
    			<img src="img/Marker/Marker6.png" width="50" height="50" />
			</button>
		</div>

		<br><br>

		<!-- Esportazione -->
		<center><label class="label">Esportazione</label>
		<div><br>
			<button class="pdf" onclick="window.location='pdf.php'">PDF</button>
			<button class="excel" onclick="location.href='excel.php'">EXCEL</button>
			<button class="word" onclick="location.href='word.php'">WORD</button>
		</div></center>

		<br><br>
		
		<!-- Tipo mappa -->
		<center><label class="label">Tipo mappa</label></center><br>
		<div>
			<label class="container" style="margin-left: 20px">Default
				<input type="radio" checked="checked" name="radio" onclick="setMap(1)">
				<span class="radio"></span>
			</label>
			<label class="container">Satellitare
				<input type="radio" name="radio" onclick="setMap(2)">
				<span class="radio"></span>
			</label>
			<label class="container" style="margin-left: 20px; margin-right: 32px; ">Ibrida
				<input type="radio" name="radio" onclick="setMap(3)">
				<span class="radio"></span>
			</label>
			<label class="container">Fisica
				<input type="radio" name="radio" onclick="setMap(4)">
				<span class="radio"></span>
			</label>
		</div><br>
		<center><label class="label">Opzioni</label></center><br>
		<label class="container" style="margin-left: 20px;">Nascondi marker
			<input type="checkbox" id="myCheck" onchange="CheckBox()">
			<span class="checkmark"></span>
		</label>
	</div>

 	<div ID="mappa" style="position:absolute;height: 100%;width: 100%;z-index: 0;top: 0;left: 0;"></div>
	<span style="font-size:30px;cursor:pointer;z-index: 1; position: fixed;color: white;" onclick="openNav()">&#9776; Menu</span>
	<center>
	<table class="cordinate">
		<tr>
			<td><input type="text" id="lat" size=15 disabled style="padding: 5px 3px 5px 3px; background-color:white;"></td>
			<td><input type="text" ID="lng" size=15 disabled style="padding: 5px 0px 5px 0px; background-color:white;"></td>
		</tr>
	</center>
 </body>
</html>