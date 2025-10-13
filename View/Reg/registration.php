<?php
require_once("../../Controller/register_auth.php");
require_once("../../Model/config.php");
require_once("../../Model/queries.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
   
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="form-container">
        <form action="../../Controller/register_auth.php" method="POST" class = "requirement">
            
            <h3>Register Now</h3>
            
            <input type="text" name="username" class="box" placeholder="Enter Your Name" id = "input-username" onkeyup = "validUserName()" required>
            <span id = "username"></span>
            <input type="password" name="password" class="box" placeholder="Enter Your Password" id = "input-password" onkeyup = "validPassword()" required>
            <span id = "password"> </span>
            <input type="email" name="email" class="box" placeholder="Enter Your Email" id = "input-email" onkeyup = "validEmail()" required>
            <span id= "email"></span>
            <input type="text" name="phn" class="box" placeholder="Enter Your Number"  required id = "input-phn-number" onkeyup = "validPhnNumbe()" require>
            <span id = "phn-number"></span>
            <input type="text" name="add" class="box" placeholder="Enter Your Address" required id = "input-address" onkeyup = "validAdrress()" require>
            <span id = "address"></span>
            <label for="role">Select Role</label>
            <select id="role" name="role" class="box" required>
                <option value="user">User</option>
                <option value="event_org">Event Organizer</option>
                <option value="admin">Admin</option>
            </select>

            <input type="submit" value="Register" class="btn" name="submit">
            <p>Already Have an account? <a href="login.php">Login Now</a></p>
        </form>
    </section>

    <script src="JS/script.js"></script>
</body>
</html>
