<?php
include("../../Controller/org_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

$id = $_GET["id"];
$event = get_event_by_id($conn, $id);

if (!$event) {
    echo "Event not found.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title       = $_POST["title"];
    $description = $_POST["description"];
    $category    = $_POST["category"];
    $price       = $_POST["price"];
    $tickets     = $_POST["tickets"];
    $date        = $_POST["date"];
    $location    = $_POST["location"];
    $status      = $_POST["status"];

    if (update_event($conn, $id, $title, $description, $category, $price, $tickets, $date, $location, $status)) {
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
    <title>Edit Event</title>
    <link rel ="stylesheet" href = "../CSS/style.css">
</head>
<body>
    <section class = "add-event">
    <div class = "header"><h3 class = "admin-header">Edit Event</h3></div>
    <form method="POST" class = "form">
        <input type="text" name="title" value="<?= $event['title']; ?>" required><br>
        <textarea name="description"><?= $event['description']; ?></textarea><br>
        <input type="text" name="category" value="<?= $event['category']; ?>" required><br>
        <input type="number" step="0.01" name="price" value="<?= $event['price']; ?>" required><br>
        <input type="number" name="tickets" value="<?= $event['total_tickets']; ?>" required><br>
        <input type="date" name="date" value="<?= $event['event_date']; ?>" required><br>
        <input type="text" name="location" value="<?= $event['location']; ?>" required><br>
        <select name="status">
            <option value="active"    <?= $event['status']=='active'?'selected':''; ?>>Active</option>
            <option value="cancelled" <?= $event['status']=='cancelled'?'selected':''; ?>>Cancelled</option>
            <option value="completed" <?= $event['status']=='completed'?'selected':''; ?>>Completed</option>
        </select><br>
        <button type="submit" class = "btn">Update Event</button>
    </form>
    </section>
    <div class = "user-header"><a href="organizer_dashboard.php" class = "btn">Back</a></div>>
</body>
</html>
