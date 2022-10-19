<!DOCTYPE html>
<html>
<head>
    <!-- Testimonial -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/Testimonials.css">
  
    <!-- Footer -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/Footer.css">

    <!-- Vari -->
    <link rel="stylesheet" type="text/css" href="css/Menubar.css">
    <link rel="stylesheet" type="text/css" href="css/Product.css">
    <link rel="stylesheet" type="text/css" href="css/ParallaxEffect.css">
    <link rel="stylesheet" type="text/css" href="css/AddToCart.css">
    <title>MM store</title>
</head>
<body>
    <script src="Script/Index.js"></script>

    <!-- Menu -->
  <header id = "navbar">
        <a class="logo" href="index.php"><img src="img\MenuBar\Logo.png" alt="logo" style="width: 30%; height: auto;"></a>
        <div>
            <div class="nav__links">
                <li><a href="Index.php">Homepage</a></li>
                <li><a href="Products.php">Prodotti</a></li>
                <li><a href="Faq.php">FAQ</a></li>
            </div>
        </div>
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


    <!-- Effetto parallasse -->
    <div class="pvideo">
        <video playsinline autoplay muted loop poster >
            <source src="img\ParallaxEffect\c.mp4" type="video/mp4">
        </video>
        <h1 class="ml11">
          <span class="text-wrapper">
            <span class="line line1"></span>
            <span class="letters">Benvenuto nel mio store</span>
          </span>
        </h1>
    </div>

    <!-- PRODOTTI -->
    <div class = "products">
        <div class="countdown">Le offerte termineranno tra:</div><br><br><p id="countdown" class="countdown"></p>
        <br><br><br>
        <div class = "container">
            <h1 class = "lg-title">I più venduti</h1>
            <p class = "text-light">Benvenuto nuovo cliente. Ecco i nostri nuovi prodotti in offerta,
            aprofittane subito!!</p>

            <div class = "product-items">
                <?php 
                    // Connessione al DBMS
                    $connection = new mysqli("localhost", "root", "", "elaborato");
                    // Controllo se già questo iscritto è presente
                    $query = "SELECT prodotto.PercorsoImmagine, prodotto.Prezzo, prodotto.Nome, prodotto.Id, prodotto.Sconto, prodotto.PercorsoImmagine, prodotto.Recensione, sum(dettaglioordine.Quantita) as quantita FROM dettaglioordine, prodotto WHERE dettaglioordine.IdProdotti = prodotto.Id and prodotto.id = any( SELECT prodotto.Id FROM prodotto WHERE prodotto.Sconto >= 75 ) group by prodotto.Id ORDER BY sum(dettaglioordine.Quantita) DESC";
                    $risultato = $connection->query($query);
                    if($risultato->num_rows == 0)
                        echo "Nessun prodotto in sconto";
                    else{
                        $n = 0;
                        while (($dataDBMS = $risultato->fetch_array()) && $n < 12) {
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
                                    echo "<p class = \"product-price\">€".$dataDBMS['Prezzo']."</p>";
                                    echo "<p class = \"product-price\">€".($dataDBMS['Prezzo']*(100-$dataDBMS['Sconto'])/100)."</p>";
                                echo "</div>";

                                echo "<div class = \"off-info\">";
                                    echo "<h2 class = \"sm-title\">Sconto ".$dataDBMS['Sconto']."%</h2>";
                                echo "</div>";
                            echo "</div>";
                            $n = $n + 1;
                        }
                    }
                 ?>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <section>
        <div class="container">
            <div class="section-title">
                <h2>Testimonials</h2>
                <span class="section-separator"></span>
                <p>Ecco cosa i nostri utenti pensano dello store.</p>
            </div>
        </div>
        <div class="testimonials-carousel-wrap">
            <div class="listing-carousel-button listing-carousel-button-next"><i class="fa fa-caret-right" style="color: #fff"></i></div>
            <div class="listing-carousel-button listing-carousel-button-prev"><i class="fa fa-caret-left" style="color: #fff"></i></div>
            <div class="testimonials-carousel">
                <div class="swiper-container">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testi-item">
                                <div class="testi-avatar"><img src="img/Testimonials/21.jpg"></div>
                                <div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
                                <div class="testimonials-text">
                                    <div class="listing-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>Il migliore store che abbia mai provato. Ho acquistato qui le mie ultime 10 paia di scarpe, ottima spedizione, ottima qualità del prodotto</p>
                                    <a href="#" class="text-link"></a>
                                    <div class="testimonials-avatar">
                                        <h3>Marco Minaudo</h3>
                                        <h4></h4>
                                    </div>
                                </div>
                                <div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
                            </div>
                        </div>

                        <!--second--->
                        <div class="swiper-slide">
                            <div class="testi-item">
                                <div class="testi-avatar"><img src="img/Testimonials/3.jpg"></div>
                                <div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
                                <div class="testimonials-text">
                                    <div class="listing-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>Mi sono innamorata di questo store❤️. Ha tutte le caratteristiche di un e-commerce come amazon, ma ha dei prezzi molto piu bassi e una qualita altissima dei prodotti. L'ho gia consigliato a tutti i miei amici</p>
                                    <a href="#" class="text-link"></a>
                                    <div class="testimonials-avatar">
                                        <h3>Isabella Bonfiglio</h3>
                                        <h4></h4>
                                    </div>
                                </div>
                                <div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
                            </div>
                        </div>

                        <!--third-->
                        <div class="swiper-slide">
                            <div class="testi-item">
                                <div class="testi-avatar"><img src="img/Testimonials/4.jpg"></div>
                                <div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
                                <div class="testimonials-text">
                                    <div class="listing-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>Sono ancora stupita per la professionalità dell'assistenza clienti e dalla velocità di spedizione, tra l'altro grautita. Sto per acquistare il mio ventesimo paio di scarpe su questo store, spero in uno sconto per il traguardo 🤩</p>
                                    <a href="#" class="text-link"></a>
                                    <div class="testimonials-avatar">
                                        <h3>Antonina Ruggirello</h3>
                                        <h4></h4>
                                    </div>
                                </div>
                                <div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
                            </div>
                        </div>

                        <!--fourth-->
                        <div class="swiper-slide">
                            <div class="testi-item">
                                <div class="testi-avatar"><img src="img/Testimonials/6.jpg"></div>
                                <div class="testimonials-text-before"><i class="fa fa-quote-right"></i></div>
                                <div class="testimonials-text">
                                    <div class="listing-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p>WOW, non ho parole per descrivere MM Store. <br>• Prezzi super competitivi <br>• Spedizione in 1 giorno <br>• Assistenza 24/24</p>
                                    <a href="#" class="text-link"></a>
                                    <div class="testimonials-avatar">
                                        <h3>Salavatore Amato</h3>
                                        <h4>Designer</h4>
                                    </div>
                                </div>
                                <div class="testimonials-text-after"><i class="fa fa-quote-left"></i></div> 
                            </div>
                        </div>
                        <!--testi end-->

                    </div>
                </div>
            </div>
            <div class="tc-pagination"></div>
        </div>
    </section>

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

   <!-- Script for testimonials -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/6.4.8/swiper-bundle.min.js"></script>
    <script src="Script/Testimonials.js"></script>

    <!-- COUNTDOWN NAVBAR-->
    <script src="Script/Index.js"></script>

    <!-- TEXT ANIMATE -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script type="text/javascript">TextAnimate();</script>

    <!-- Procuts list -->
    <script src="https://kit.fontawesome.com/dbed6b6114.js" crossorigin="anonymous"></script>

    <!-- Add to cart -->
    <script src="Script/util.js"></script>
    <script src="Script/main.js"></script> 
</body>
</html>