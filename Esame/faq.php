<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="img/Faq/favicon-32x32.png">
    <title>FAQ</title>

    <link rel="stylesheet" type="text/css" href="css/Menubar.css">
    <link rel="stylesheet" href="css/faq.css">
</head>
<body>

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

    <main class="wrapper" style="margin-top:13%; ">
        <div class="image__wrapper">
            <div class="image__wrapper_inner">

            </div>
            <img class="box" src="img/Faq/illustration-box-desktop.svg" alt="box">
        </div>
        <div class="accordion__wrapper">
            <h1 class="title__accordion">FAQ</h1>
            <div class="questions__accordions">
                <div class="question-answer__accordion">
                    <div class="question">
                        <h3 class="title__question">
                            Quali metodi di pagamento sono accettati?
                        </h3>
                        <img src="img/Faq/icon-arrow-down.svg" >
                    </div>
                    <div class="answer">
                        Sono accettati tutti le carte di credito e di debito di qualsiasi circuito
                    </div>
                </div>

                <div class="question-answer__accordion">
                    <div class="question">
                        <h3 class="title__question">
                            Quali sono i tempi di spedizione?
                        </h3>
                        <img src="img/Faq/icon-arrow-down.svg" >
                    </div>
                    <div class="answer ">
                        Dipende dallo stato in cui risiedi ma vanno da un minimo di 1 giorno ad un massimo di 5 giorni
                    </div>
                </div>

                <div class="question-answer__accordion">
                    <div class="question">
                        <h3 class="title__question">
                            Quanto dura la garanzia dei prodotti?
                        </h3>
                        <img src="img/Faq/icon-arrow-down.svg" >
                    </div>
                    <div class="answer ">
                        La garanzia dei prodotti dura 2 anni ed è applicabile per tutti i prodotti danneggiati non intenzionalmente
                    </div>
                </div>

                <div class="question-answer__accordion">
                    <div class="question">
                        <h3 class="title__question">
                            Quanto costa la spedizione dei prodotti <br>che  ho acquistato?
                        </h3>
                        <img src="img/Faq/icon-arrow-down.svg" >
                    </div>
                    <div class="answer ">
                        La spedizione è gratuita.
                    </div>
                </div>
                
                <div class="question-answer__accordion">
                    <div class="question">
                        <h3 class="title__question">
                            Ho inserito i miei dati per acquistare un prodotto. Chi ne avrà accesso?
                        </h3>
                        <img src="img/Faq/icon-arrow-down.svg" >
                    </div>
                    <div class="answer ">
                        I dati sono al sicuro nei nostri server e sono criptati con i migliori algoritmi presenti nel mercato  
                    </div>
                </div>

            </div>
        </div>
    </main>

    
    <script src="Script/faq.js"></script>
</body>
</html>