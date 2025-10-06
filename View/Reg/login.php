<?php
include("../../Controller/login_auth.php"); // handles POST and redirects, or does nothing on GET
include("../../Model/config.php");          // you wanted includes like in home.php
include("../../Model/queries.php");         // (not strictly needed here, but kept as per your structure)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Font Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="form-container">
        <?php
        if (!empty($_GET['error'])) {
            echo "<p style='color:red;'>" . htmlspecialchars($_GET['error']) . "</p>";
        }
        ?>

        <!-- Form posts to login_auth.php -->
        <form action="../../Controller/login_auth.php" method="POST">
            <h3>Login</h3>
            <input type="email" name="email" class="box" placeholder="Enter Your Email" required>
            <input type="password" name="pass" class="box" placeholder="Enter Your Password" required>

            <label for="role">Select Role</label>
            <select id="role" name="role" class="box" required>
                <option value="user">User</option>
                <option value="event_org">Event Organizer</option>
                <option value="admin">Admin</option>
            </select>

            <input type="submit" value="Login" class="btn" name="submit">
            <p>Don't Have an account? <a href="registration.php">Register Now</a></p>
        </form>
    </section>
</body>
</html>
