<?php

session_start();


if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../Reg/login.php");
    exit();
}


if (!isset($_SESSION["admin_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
