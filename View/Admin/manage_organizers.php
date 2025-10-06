<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

// Delete organizer
if (isset($_GET["delete_id"])) {
    $org_id = intval($_GET["delete_id"]);
    if (admin_delete_organizer($conn, $org_id)) {
        echo "<p>✅ Organizer deleted successfully.</p>";
    } else {
        echo "<p>❌ Error deleting organizer: " . mysqli_error($conn) . "</p>";
    }
}

// Fetch all organizers
$result = get_all_organizers($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Organizers</title>
</head>
<body>

<h1>Manage Event Organizers</h1>
<p>Welcome, <strong><?php echo $_SESSION["username"]; ?></strong></p>
<hr>

<a href="admin_dashboard.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Organizer Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Organization Name</th>
        <th>Address</th>
        <th>Created At</th>
        <th>Actions</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row["org_id"]; ?></td>
                <td><?php echo htmlspecialchars($row["org_name"]); ?></td>
                <td><?php echo htmlspecialchars($row["email"]); ?></td>
                <td><?php echo htmlspecialchars($row["phone"] ?? "N/A"); ?></td>
                <td><?php echo htmlspecialchars($row["organization_name"] ?? "N/A"); ?></td>
                <td><?php echo htmlspecialchars($row["address"] ?? "N/A"); ?></td>
                <td><?php echo $row["created_at"]; ?></td>
                <td>
                    <a href="?delete_id=<?php echo $row['org_id']; ?>" onclick="return confirm('Are you sure you want to delete this organizer?');">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="8">No organizers found.</td></tr>
    <?php endif; ?>

</table>

</body>
</html>
