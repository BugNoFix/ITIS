<!-- Aggiungere messaggio errore elimanare echo -->
<html lang="en">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <script
         src="https://kit.fontawesome.com/64d58efce2.js"
         crossorigin="anonymous"
         ></script>
      <link rel="stylesheet" href="css/Login.css" />
      <title>Login e Registrazione</title>
      <?php 
         /*CONTROLLI*/
         $pass = false;
         $utente = false;
         // Login
         if(isset($_POST['log'])){
            //Setto le variabili
            $email = $_POST['email2'];
            $password = $_POST['password2'];

            // Connetto al DBMS
            $connessione = new mysqli("localhost", "root", "", "googlemaps");
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

         $utentereg = false;
         $conf = false;
         // Registrazione
         if(isset($_POST['reg'])){
            // Setto le variabili
            $email = $_POST['email'];
            $password = $_POST['password'];
            $birthday = $_POST['birthday'];

            // Connessione al DBMS
            $connection = new mysqli("localhost", "root", "", "googlemaps");
            // Controllo se già questo iscritto è presente
            $query = "SELECT * FROM utente WHERE Email = '$email'";
            $risultato = $connection->query($query);
            // Controllo se la query ha dato risultati
            if($risultato->num_rows != 0)
               $utentereg = true;
            else{
               $conf = true;
               //Cript la password
               $password = crypt($password, 10);
               // Inserisco l'utente nel database
               $query = "INSERT INTO `utente` (`DataNascita`, `Email`, `Password`) VALUES ('$birthday', '$email', '$password');";
               $connection->query($query);
            }
            #$risultato->free();
            $connection->close();
         }

       ?>
   </head>
   <body>
      <div class="container">
         <div class="forms-container">
            <div class="signin-signup">

               <!-- login -->
               <form action="login.php?x=2" method="POST" class="sign-in-form">
                  <h2 class="title">Login</h2>
                  <div class="input-field">
                     <i class="fas fa-user"></i>
                     <input type="text" placeholder="Email" name="email2"required />
                  </div>
                  <div class="input-field">
                     <i class="fas fa-lock"></i>
                     <input type="password" placeholder="Password" name="password2"required />
                  </div>
                  <input type="submit" value="Login" name="log" class="btn solid" />
                  <div class="error"><?php if($utente){echo"Utente non registrato";} elseif ($pass) {echo"Password Errata";} ?></div>
               </form>

               <!-- Registrazione -->
               <form action="login.php?x=1" method="POST" class="sign-up-form">
                  <h2 class="title">Registrazione</h2>
                  <div class="input-field">
                     <i class="fas fa-envelope"></i>
                     <input type="email" placeholder="Email" name="email" required/>
                  </div>
                  <div class="input-field">
                     <i class="fas fa-lock"></i>
                     <input type="password" placeholder="Password" name="password" required/>
                  </div>
                  <div class="input-field">
                     <i class="fas fa-user"></i>
                     <input type="date" placeholder="Data di nascita" name="birthday" required/>
                  </div>
                  <input type="submit" class="btn" value="Registrazione" name="reg" />
                  <?php 
                     if($utentereg)
                        echo "<div class=\"error\">Utente gia registrato</div>";
                     if($conf)
                        echo "<div class=\"correct\">Registrazione effettuata</div>";
                  ?>
               </form>
            </div>
         </div>
         <div class="panels-container">
            <div class="panel left-panel">
               <div class="content">
                  <h3>Registrazione</h3>
                  <p>
                     Hey non sei registrato, che aspetti, vai nell'area di registrazione e inizia a salvare tutti i tuoi posti preferiti
                  </p>
                  <button class="btn transparent" id="sign-up-btn">
                  Registrazione
                  </button>
               </div>
               <img src="img/log2.png" class="image" alt="" />
            </div>
            <div class="panel right-panel">
               <div class="content">
                  <h3>Login</h3>
                  <p>
                     Hey sei gia registrato, allora vai nell'area login per vedere i tuoi marker salvati
                  </p>
                  <button class="btn transparent" id="sign-in-btn">
                  Login
                  </button>
               </div>
               <img src="img/register.png" class="image" alt="" />
            </div>
         </div>
      </div>
      <script src="script/Login.js"></script>
   </body>
</html>