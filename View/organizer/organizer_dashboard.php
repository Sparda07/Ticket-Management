<?php
include("../../Controller/org_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

$org_id = $_SESSION["org_id"];
$result = get_events_by_org($conn, $org_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Organizer Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?= $_SESSION["username"]; ?> (Event Organizer)</h1>

    <a href="add_event.php">➕ Add New Event</a>

    <h2>Your Events</h2>
    <table border="1" cellpadding="10">
        <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Date</th>
            <th>Tickets</th>
            <th>Price</th>
            <th>Location</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php display_organizer_events($result); ?>
    </table>

    <a href="../Reg/logout.php">Logout</a>
</body>
</html>
