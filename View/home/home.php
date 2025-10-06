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
                Discover events – find what matches your mood.<br>
                Stay updated – never miss out on exciting live experiences.<br>
                Take a day off, grab your ticket, and make memories that last forever.
            </p>
            <a href="#" class="btn">About Us</a>
        </div>

        <div class="home-img">
            <img src="images/home.png" alt="home img" height="200px">
        </div>
    </section>

    <section class="home-category">
        <h1 class="title">Event Categories</h1>
        <div class="box-container">
            <div class="box">
                <img src="images/Concert.svg" alt="" height="150px">
                <h3>Music</h3>
                <a href="../User/order_ticket.php" class="btn">Book Ticket</a>
            </div>

            <div class="box">
                <img src="images/Festivals.jpg" alt="" height="150px">
                <h3>Festivals & Fairs</h3>
                <a href="../User/order_ticket.php" class="btn">Book Ticket</a>
            </div>

            <div class="box">
                <img src="images/Sports.jpg" alt="sports-img" height="150px">
                <h3>Sports</h3>
                <a href="../User/order_ticket.php" class="btn">Book Ticket</a>
            </div>
        </div>
    </section>

    <hr>
    <h2>User Options</h2>
    <ul>
        <li><a href="order_ticket.php">🎟️ Order Ticket</a></li>
        <li><a href="my_ticket.php">📋 My Tickets</a></li>
        <li><a href="cancel_ticket.php">❌ Cancel Ticket</a></li>
        <li><a href="../Reg/logout.php">🚪 Logout</a></li>
    </ul>
</div>

</body>
</html>
