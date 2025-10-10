<?php
include("../../Controller/auth.php");
include("../../Model/config.php");
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Home - TickLive</title>
</head>
<body>

<div class="home-bg">
    <section class="home">
        <div class="content">
            <span>Don’t just watch — be there.</span>
            <h3>Welcome to Live-Event</h3>
            <p>
                Your one-stop destination for live events!<br>
                From concerts, sports, and festivals to theatre and special shows — we bring you the best events happening around you.<br>
                Book tickets easily – hassle-free and secure.<br>
                Take a day off, grab your ticket, and make memories that last forever.
            </p>
            
        </div>

        <div class="home-img">
            <img src="images/home.png" alt="home img" height="150px">
        </div>
    </section>

    <section class="home-category">
        
        <div class="box-container">
            <div class="box">
                <a href="order_ticket.php" class="btn"><img src="images/order-now.png" alt="" height="150px">
                Order Ticket</a>
            </div>

            <div class="box">
                <a href="my_ticket.php" class="btn"><img src="images/list.png" alt="" height="150px">
                My Tickets
                </a>
            </div>

            <div class="box">
                <a href="../User/order_ticket.php" class="delete-btn"><img src="images/cencel.svg" alt="Cancel Ticket" height="150px">
                Cencel Ticket</a>
            </div>
            <div class="box">
                <a href="../Reg/logout.php" class="delete-btn"><img src="images/logout.png" alt="LOgout" height="150px">
                Logout</a>
            </div>
        </div>
    </section>
    
</div>

</body>
</html>
