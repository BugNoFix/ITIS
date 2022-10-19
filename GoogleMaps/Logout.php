<?php
    // distruzione sessione corrente
    session_start();
    session_unset();
    session_destroy();
    $_SESSION = array();
    header('Location: login.php');
    die();

    //Si puo mettere del codice html per dire sessione scaduda o conclusa ma è inutile
?>