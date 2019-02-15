<?php
require_once(__DIR__ . '/header.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    if (isset($_POST['liam2_add_another_email'])) {
        $result = api(json_encode(array(
                "cmd" => "create",
                "paramJS" => array(
                    "table" => "liam2_email",
                    "row" => array(
                        "liam2_email_text" => htmlspecialchars($_POST['liam2_email_text']),
                        "only_verify_mail" => true
                    )
                )
            )
        ));
        $result = json_decode($result, true);
        if (count($result) > 1) {
            $success = 'A verification link has been sent to your email address.';
        } else {
            $error = $result[0]['message'];
        }
        if (isset($success)) {
            $email_id = $result[1]["element_id"];
            $result = api(json_encode(array(
                "cmd" => "create",
                "paramJS" => array(
                    "table" => "liam2_User_email",
                    "row" => [
                        "liam2_User_id_fk_164887" => $_SESSION['user_id'],
                        "liam2_email_id_fk_396224" => $email_id
                    ]
                )
            )));
        }
    }
    if (isset($_POST['liam2_select_email'])) {
        $user_email_id = htmlspecialchars($_POST['email']);
        $result = api(json_encode(array(
            "cmd" => "makeTransition",
            "paramJS" => array(
                "table" => "liam2_User_email",
                "row" => [
                    "liam2_User_email_id" => $user_email_id,
                    "state_id" => 11
                ]
            )
        )));
        $success = 'Email successfully selected.';
    }
    if (isset($_POST['liam2_unselect_email'])) {
        $user_email_id = htmlspecialchars($_POST['email']);
        $result = api(json_encode(array(
            "cmd" => "makeTransition",
            "paramJS" => array(
                "table" => "liam2_User_email",
                "row" => [
                    "liam2_User_email_id" => $user_email_id,
                    "state_id" => 12
                ]
            )
        )));
        $success = 'Email successfully unselected.';
    }
    if (isset($_POST['liam2_delete_email'])) {
        $email_id = htmlspecialchars($_POST['email']);
        $user_email_id = htmlspecialchars($_POST['delete_user_email_id']);
        $result = api(json_encode(array(
            "cmd" => "makeTransition",
            "paramJS" => array(
                "table" => "liam2_User_email",
                "row" => [
                    "liam2_User_email_id" => $user_email_id,
                    "state_id" => 12
                ]
            )
        )));
        $result = api(json_encode(array(
            "cmd" => "makeTransition",
            "paramJS" => array(
                "table" => "liam2_email",
                "row" => [
                    "liam2_email_id" => $email_id,
                    "state_id" => 16
                ]
            )
        )));
        $success = 'Email successfully deleted.';
    }
    $user_emails = json_decode(api(json_encode(array(
        "cmd" => "read",
        "paramJS" => array(
            "table" => "liam2_User_email",
            "where" => "liam2_User_id = $_SESSION[user_id]"
        )
    ))), true);
    $selected_user_emails = array();
    $unselected_user_emails = array();
    foreach ($user_emails as $key => $user_email) {
        $email_id = $user_email['liam2_email_id_fk_396224']['liam2_email_id'];
        $verified_email = json_decode(api(json_encode(array(
            "cmd" => "read",
            "paramJS" => array(
                "table" => "liam2_email",
                "where" => "liam2_email_id = $email_id && a.state_id = 14"
            )
        ))), true);
        if (!$verified_email) {
            unset($user_emails[$key]);
            continue;
        }
        if ($user_email['state_id']['state_id'] == 11) {
            array_push($selected_user_emails, $user_email);
        } elseif ($user_email['state_id']['state_id'] == 12) {
            array_push($unselected_user_emails, $user_email);
        }
    }
    require_once(__DIR__ . '/templates/manage_emails.php');
}