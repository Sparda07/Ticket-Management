<?php
// Controller/admin_auth.php
session_start();

// Only allow logged-in users with role 'admin'
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../Reg/login.php");
    exit();
}

// Ensure admin_id exists in session
if (!isset($_SESSION["admin_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
