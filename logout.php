<?php
require_once(__DIR__ . '/header.php');
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
} else {
    session_destroy();
    header("Location: login.php");
    exit();
}