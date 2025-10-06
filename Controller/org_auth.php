<?php
// Controller/org_auth.php
session_start();

// Only allow logged-in users with role 'event_org'
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "event_org") {
    header("Location: ../Reg/login.php");
    exit();
}

// Ensure org_id exists in session
if (!isset($_SESSION["org_id"])) {
    session_unset();
    session_destroy();
    header("Location: ../Reg/login.php");
    exit();
}
