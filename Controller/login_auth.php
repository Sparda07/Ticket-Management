<?php

session_start();


if (isset($_SESSION["role"]) && $_SESSION["role"] === "user" && isset($_SESSION["user_id"])) {
    header("Location: ../View/home/home.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../Model/config.php");
    include("../Model/queries.php");

    $email    = $_POST["email"] ?? '';
    $password = $_POST["pass"]  ?? '';
    $role     = $_POST["role"]  ?? '';

    if ($email === '' || $password === '' || $role === '') {
        header("Location: ../View/Reg/login.php?error=Please+fill+all+fields");
        exit();
    }

    $row = get_account_by_email($conn, $role, $email);

    if ($row && password_verify($password, $row["password"])) {
        
        $_SESSION["username"] = $row["username"] ?? $row["org_name"] ?? $row["admin_name"];
        $_SESSION["role"] = $role;

        
        if ($role === "user" && isset($row["user_id"])) {
            $_SESSION["user_id"] = $row["user_id"];
        } elseif ($role === "event_org" && isset($row["org_id"])) {
            $_SESSION["org_id"] = $row["org_id"];
        } elseif ($role === "admin" && isset($row["admin_id"])) {
            $_SESSION["admin_id"] = $row["admin_id"];
        }

        
        if ($role === "admin") {
            header("Location: ../View/admin/admin_dashboard.php");
        } elseif ($role === "event_org") {
            header("Location: ../View/organizer/organizer_dashboard.php");
        } else {
            header("Location: ../View/home/home.php");
        }
        exit();
    }

    
    header("Location: ../View/Reg/login.php");
    exit();
}


