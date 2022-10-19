<!DOCTYPE html>
<html>
<head>
    <!-- Footer -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/> <!-- Problema spazio menu -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/Footer.css">

    <!-- Vari -->
    <link rel="stylesheet" type="text/css" href="css/Menubar.css">
    <link rel="stylesheet" type="text/css" href="css/Product.css">
    <link rel="stylesheet" type="text/css" href="css/ParallaxEffect.css">
    <link rel="stylesheet" type="text/css" href="css/AddToCart.css">
    <title>Prodotti</title>
</head>
<body>
    <script src="Script/Index.js"></script>

    <!-- Menu -->
    <header id = "navbar2" class="navbar1">
        <a class="logo" href="index.php"><img src="img\MenuBar\Logo.png" alt="logo" style="width: 30%; height: auto;"></a>
        <nav>
            <div class="nav__links">
                <li><a href="Index.php">Homepage</a></li>
                <li><a href="Products.php">Prodotti</a></li>
                <li><a href="Faq.php">FAQ</a></li>
            </div>
        </nav>
        <?php 
            session_start();
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

    <!-- PRODOTTI -->
    <div class = "products">
        <br><br><br><br><br><br><br><br>
        <form action="Products.php" method="POST">
            <select name="Order" onchange="this.form.submit();" class="select">
                <option hidden="">Ordina per</option>
                <option value="PrezzoScontato">Ordina per Prezzo</option>
                <option value="IdCategoria">Ordina per Categoria</option>
                <option value="Sconto Desc">Ordina per Sconto</option>
                <option value="Giovani">I più acquistati dai giovani</option>
            </select>
            <br><br>
        </form>
        <div class = "container">
            <h1 class = "lg-title">Ecco i nostri prodotti</h1>
            <p class = "text-light">Benvenuto nuovo cliente. Ecco tutti i nostri prodotti</p>

            <div class = "product-items">
                <?php
                    // Connessione al DBMS
                    $connection = new mysqli("localhost", "root", "", "elaborato");
                    // Appena apri la pagina, il select da vuoto, ma si click allora da un valore
                    if (!isset($_POST['Order']))
                        $order = "PrezzoScontato";
                    else
                        $order = $_POST['Order'];
                    $query = "SELECT *, Prezzo*(100-Sconto)/100 as PrezzoScontato FROM `prodotto` ORDER BY $order";
                    if (isset($_POST['Order']) and $_POST['Order'] == "Giovani")
                        $query =    "SELECT *
                                    FROM utente, prodotto, dettaglioordine, ordine
                                    WHERE utente.CodiceFiscale = ordine.CodiceFiscaleUtente and ordine.Id = dettaglioordine.IdOrdine and dettaglioordine.IdProdotti = prodotto.Id and utente.CodiceFiscale = any(
                                        SELECT utente.CodiceFiscale
                                        FROM utente
                                        WHERE DATEDIFF(CURRENT_DATE, utente.DataNascita)/365.25 <= 18
                                    )
                                    GROUP BY prodotto.Id 
                                    ORDER BY sum(dettaglioordine.Quantita) DESC";
                    $risultato = $connection->query($query);
                    if($risultato->num_rows == 0)
                        echo "Nessun prodotto in sconto";
                    else{
                        while ($dataDBMS = $risultato->fetch_array()) {
                            echo "<div class = \"product\">";
                                echo "<div class = \"product-content\">";
                                    echo "<div class = \"product-img\">";
                                        echo "<img src = ".$dataDBMS['PercorsoImmagine']." alt = \"product image\">";
                                    echo "</div>";
                                    echo "<div class = \"product-btns\">";
                                        // Aggiungere info prodotto con element
                                        echo "<button type = \"button\" class = \"btn-cart js-cd-add-to-cart\" data-price=".$dataDBMS['Prezzo']." price-off=".($dataDBMS['Prezzo']*(100-$dataDBMS['Sconto'])/100)." href=\"#0\" img=".$dataDBMS['PercorsoImmagine']." name=\"".$dataDBMS['Nome']."\" idProduct =".$dataDBMS['Id']."> Aggiungi";
                                        echo "</button>";
                                        echo "<form action=\"Checkout.php\" method= \"POST\">";
                                        echo "<button type = \"submit\" class = \"btn-buy\" name=\"IdP\" value=".$dataDBMS['Id']."> Compra ora";
                                        echo "</button>";
                                        echo "</form>";
                                    echo "</div>";
                                echo "</div>";

                                echo "<div class = \"product-info\">";
                                    echo "<div class = \"product-info-top\">";
                                        echo "<div class = \"rating\">";
                                            for ($i=0; $i < $dataDBMS['Recensione']; $i++)
                                                echo "<span><i class = \"fas fa-star\"></i></span>";
                                            for ($i=0; $i < 5 - $dataDBMS['Recensione']; $i++)
                                                echo "<span><i class = \"far fa-star\"></i></span>";
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<a href = \"#\" class = \"product-name\">".$dataDBMS['Nome']."</a>";
                                    if ($dataDBMS['Sconto'] > 0){
                                        echo "<p class = \"product-price\">€".$dataDBMS['Prezzo']."</p>";
                                        echo "<p class = \"product-price\">€".($dataDBMS['Prezzo']*(100-$dataDBMS['Sconto'])/100)."</p>";
                                    }
                                    else{
                                        echo "<p class = \"product-price2\">€".$dataDBMS['Prezzo']."</p>";
                                    }
                                echo "</div>";

                                echo "<div class = \"off-info\">";
                                    if ($dataDBMS['Sconto'] > 0)
                                    echo "<h2 class = \"sm-title\">Sconto ".$dataDBMS['Sconto']."%</h2>";
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                 ?>
            </div>
        </div>
    </div>

   <!-- Site footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <br><br><br>
                    <h6>Chi siamo</h6>
                    <p class="text-justify">MM Store è un nuovo e-commerce pensato e progettatto per i clienti, in modo che abbiano il massimo      comfort, la massima qualità con prezzi accessibili e spedizioni ultra veloci. Il creatore di questo sito è Minaudo Marco, un nuono imprenditore nell'era digitale che vuole rivoluzionare il concetto di e-commerce e renderlo una realtà adatta a tutti.</p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <br><br><br>
                    <h6>La nostra storia</h6>
                    <p class="text-justify">Questo e-commerce nasce nel 2021 con la scusa di creare un sito per l'esame di stato, ma il creatore vede un futuro radioso e decide di investire sul proprio sito aprendo una azienda incentrata sulla vendita online dei prodotti</p>
                </div>

                <div class="col-xs-6 col-md-3">
                    <br><br><br>
                    <h6>Privacy</h6>
                    <p class="text-justify">MM store offre la massima sicurezza in ambito della protezione dei dati personali, tutti i dati vengono gestiti correttamente</p>
                </div>
                </div>
            </div>
            <hr>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by
                        <a href="#">Minaudo Marco</a>.
                    </p>
                </div>

                <div class="col-md-4 col-sm-6 col-xs-12">
                    <ul class="social-icons">
                        <li><a class="facebook" href="https://www.facebook.com/marco.minaudo.1/"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="github" href="https://github.com/BugNoFix"><i class="fa fa-github"></i></a></li>
                        <li><a class="dribbble" href="https://www.instagram.com/marcominaudo/"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Carrello -->
    <div class="cd-cart cd-cart--empty js-cd-cart">
        <a href="#0" class="cd-cart__trigger text-replace">
            <ul class="cd-cart__count"> <!-- Counter carrello -->
                <li><script type="text/javascript">
                    setCount();
                </script></li>
                <li>0</li>
            </ul>
        </a>

        <div class="cd-cart__content">
            <div class="cd-cart__layout">
                <header class="cd-cart__header">
                    <h2>Carrello</h2>
                    <span class="cd-cart__undo">Articolo rimosso. <a href="#0">Torna indietro</a></span>
                </header>
                
                <div class="cd-cart__body">
                    <ul id="CartAll">
                        <!-- I prodotti saranno aggiunti qui -->
                        <script type="text/javascript">setCart();</script>
                    </ul>
                </div>

                <div class="cd-cart__footer">
                    <a href="Checkout.php" class="cd-cart__checkout">
                        <em>Checkout €<span><script type="text/javascript">document.write(price)</script></span>
                            <svg class="icon icon--sm" viewBox="0 0 24 24"><g fill="none" stroke="currentColor"><line stroke-width="2" stroke-linecap="round" stroke-linejoin="round" x1="3" y1="12" x2="21" y2="12"/><polyline stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="15,6 21,12 15,18 "/></g>
                            </svg>
                        </em>
                    </a>
                </div>
            </div>
        </div>
    </div>
 
    <!-- Procuts list -->
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>

    <!-- Add to cart -->
    <script src="Script/util.js"></script> 
    <script src="Script/main.js"></script> 

</body>
</html>