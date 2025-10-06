<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

// Delete event
if (isset($_GET["delete_id"])) {
    $event_id = intval($_GET["delete_id"]);
    if (admin_delete_event($conn, $event_id)) {
        echo "<p>✅ Event deleted successfully.</p>";
    } else {
        echo "<p>❌ Error deleting event: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all events
$result = get_all_events($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Events</title>
</head>
<body>

<h1>Manage Events</h1>
<p>Welcome, <strong><?php echo $_SESSION["username"]; ?></strong></p>
<hr>

<a href="admin_dashboard.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Organizer ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Total Tickets</th>
        <th>Event Date</th>
        <th>Location</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row["event_id"]; ?></td>
                <td><?php echo $row["org_id"]; ?></td>
                <td><?php echo htmlspecialchars($row["title"]); ?></td>
                <td><?php echo htmlspecialchars($row["category"]); ?></td>
                <td><?php echo $row["price"]; ?></td>
                <td><?php echo $row["total_tickets"]; ?></td>
                <td><?php echo $row["event_date"]; ?></td>
                <td><?php echo htmlspecialchars($row["location"]); ?></td>
                <td><?php echo $row["status"]; ?></td>
                <td>
                    <a href="?delete_id=<?php echo $row['event_id']; ?>" onclick="return confirm('Are you sure you want to delete this event?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="10">No events found.</td></tr>
    <?php endif; ?>

</table>

</body>
</html>
