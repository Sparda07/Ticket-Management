<?php
include("../../Controller/org_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $org_id      = $_SESSION["org_id"];
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $category    = $_POST["category"];
    $price       = $_POST["price"];
    $tickets     = $_POST["tickets"];
    $date        = $_POST["date"];
    $location    = $_POST["location"];

    if (create_event($conn, $org_id, $title, $description, $category, $price, $tickets, $date, $location)) {
        header("Location: organizer_dashboard.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Event</title>
</head>
<body>
    <h1>Add New Event</h1>
    <form method="POST">
        <input type="text" name="title" placeholder="Event Title" required><br>
        <textarea name="description" placeholder="Event Description" required></textarea><br>
        <input type="text" name="category" placeholder="Category" required><br>
        <input type="number" step="0.01" name="price" placeholder="Price" required><br>
        <input type="number" name="tickets" placeholder="Total Tickets" required><br>
        <input type="date" name="date" required><br>
        <input type="text" name="location" placeholder="Location" required><br>
        <button type="submit">Add Event</button>
    </form>
    <a href="../Reg/logout.php">Logout</a>
</body>
</html>
