<?php

session_start();


if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user") {
    header("Location: ../Reg/login.php");
    exit();
}


if (!isset($_SESSION["user_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
?>
