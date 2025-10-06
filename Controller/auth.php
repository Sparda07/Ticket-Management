<?php
// Controller/auth.php
session_start();

// ✅ Only allow logged-in users with role 'user'
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
    header("Location: ../Reg/login.php");
    exit();
}

// ✅ Optionally, you can check if session expired (optional)
if (!isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
?>
