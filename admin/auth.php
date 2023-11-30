<?php
session_start();

if (!isset($_COOKIE["login_status"]) || $_COOKIE["login_status"] !== "true") {
    header("Location: ../login.php");
    exit;
}
?>