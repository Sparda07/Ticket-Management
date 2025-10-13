<?php
// Controller/org_auth.php
session_start();


if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "event_org") {
    header("Location: ../Reg/login.php");
    exit();
}


if (!isset($_SESSION["org_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
