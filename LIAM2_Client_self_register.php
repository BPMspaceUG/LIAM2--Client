<?php
require_once(__DIR__ . '/inc/LIAM2_Client_header.inc.php');
require_once(__DIR__ . '/inc/captcha/captcha.inc.php');
require_once(__DIR__ . '/inc/LIAM2_Client_translate.inc.php');
require_once(__DIR__ . '/inc/php-jwt-master/src/JWT.inc.php');
use \Firebase\JWT\JWT;
if (isset($_POST['self_register'])) {
    if (file_exists($_POST['captcha-image'])) unlink($_POST['captcha-image']);
    $sentCode = htmlspecialchars($_POST['code']);
    $result = (int)$_POST['result'];
    if (getExpressionResult($sentCode) !== $result) {
        $error = 'Wrong Captcha.';
    } else {
        $email = htmlspecialchars($_POST['email']);
        $result = api(json_encode(array(
                "cmd" => "create",
                "paramJS" => array(
                    "table" => "liam2_email",
                    "row" => array(
                        "liam2_email_text" => $email
                    )
                )
            )
        ));
        $result = json_decode($result, true);
        if (count($result) > 1) {
            $email_id = $result[1]['element_id'];
            $jwt_key = AUTH_KEY;
            $jwt_token = array(
                "iss" => "liam2",
                "aud" => $email_id,
                "iat" => time(),
                "exp" => time() + 10800
            );

            /**
             * IMPORTANT:
             * You must specify supported algorithms for your application. See
             * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
             * for a list of spec-compliant algorithms.
             */
            $jwt = JWT::encode($jwt_token, $jwt_key);

            // Mail Content
            $subject = "Please confirm your Mail Adress";
            $link = "//" . $_SERVER['SERVER_NAME'] . "/LIAM2_Client_register.php?token=" . $jwt;
            $msg = translate('LIAM2 CLIENT Self registration email', 'en');
            $msg = str_replace('$link', $link, $msg);
            // Format and Send Mail
            $msg = wordwrap($msg, 70);
            if (mail($email, $subject, $msg)) {
                $success = 'A verification link has been sent to your email address.';
            } else {
                $error = "The email can't be send";
            }
        } else {
            $error = $result[0]['message'];
        }
    }
}
generateImage($expression->n1.' + '.$expression->n2.' =', $captchaImage);
require_once(__DIR__ . '/inc/templates/LIAM2_Client_self_register.inc.php');