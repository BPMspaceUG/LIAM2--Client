<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/inc/header.inc.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    session_destroy();
    header("Location: login.php");
    exit();
}