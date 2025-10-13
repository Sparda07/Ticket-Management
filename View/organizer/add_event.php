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
    <link rel = "stylesheet" href = "../CSS/style.css">
</head>
<body>
    
    <section class = "add-event">
        <div class = "header"><h3 class = "admin-header">Add New Event</h3></div>
        <form method="POST" class = "form">
            <input type="text" name="title" placeholder="Event Title" required><br>
            <textarea name="description" placeholder="Event Description" required></textarea><br>
            <input type="text" name="category" placeholder="Category" required><br>
            <input type="number" step="0.01" name="price" placeholder="Price" required><br>
            <input type="number" name="tickets" placeholder="Total Tickets" required><br>
            <input type="date" name="date" required><br>
            <input type="text" name="location" placeholder="Location" required><br>
            <button type="submit" class = "btn">Add Event</button>
        </form>
    </section>
    <div class = "user-header"><a href="organizer_dashboard.php" class = "btn">Back</a></div>
</body>
</html>
