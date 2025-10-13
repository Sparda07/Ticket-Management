<?php

session_start();


if (file_exists("../Model/config.php")) {
    require_once("../Model/config.php");
    require_once("../Model/queries.php");
} elseif (file_exists("../../Model/config.php")) {
    require_once("../../Model/config.php");
    require_once("../../Model/queries.php");
} else {
    die(" Model files not found. Check folder names and paths.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';
    $email    = $_POST["email"]    ?? '';
    $phn      = $_POST["phn"]      ?? '';
    $add      = $_POST["add"]      ?? '';
    $role     = $_POST["role"]     ?? '';

    if ($username && $password && $email && $phn && $add && $role) {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        
        $check = get_account_by_email($conn, $role, $email);

        if ($check) {
            echo "<p style='color:red;'>Account already exists with this email.</p>";
            echo "<p><a href='../View/Reg/registration.php'>Back to Registration</a></p>";
        } else {
            $ok = create_account($conn, $role, $username, $hash, $email, $phn, $add);

            if ($ok) {
                echo "<p style='color:green;'> You are registered successfully as $role.</p>";
                echo "<p><a href='../View/Reg/login.php'>Click here to Login</a></p>";
            } else {
                echo "<p style='color:red;'> Error: Could not register. Please try again.</p>";
                echo "<p><a href='../View/Reg/registration.php'>Back to Registration</a></p>";
            }
        }
    } else {
        echo "<p style='color:red;'> All fields are required.</p>";
        echo "<p><a href='../View/Reg/registration.php'>Back to Registration</a></p>";
    }

    mysqli_close($conn);
}


?>
