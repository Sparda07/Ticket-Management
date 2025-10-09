<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

// Handle delete request
if (isset($_GET['delete_id'])) {
    $user_id = intval($_GET['delete_id']);
    admin_delete_user($conn, $user_id);
    header("Location: manage_users.php");
    exit();
}

// Fetch all users
$result = get_all_users($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Users</title>
    <link rel = "stylesheet" href = "../CSS/style.css">
</head>
<body>
    <div class = "rolling-section">
        <header class = "header">
            <h3 class = "admin-header">Manage Users</h2>
        </header>
        <div class = "back-div"><a href="admin_dashboard.php" class = "delete-btn back">← Back to Dashboard</a> </div>
    </div>

    <section class = "header header-table">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

            <?php if ($result && mysqli_num_rows($result) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row["user_id"]; ?></td>
                        <td><?php echo htmlspecialchars($row["username"]); ?></td>
                        <td><?php echo htmlspecialchars($row["email"]); ?></td>
                        <td>
                            <a href="?delete_id=<?php echo $row['user_id']; ?>"
                            onclick="return confirm('Are you sure you want to delete this user?');" class = "delete-btn">
                            Delete
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            <?php else: ?>
                <tr><td colspan="4">No users found.</td></tr>
            <?php endif; ?>
        </table>
     </section>
    
</body>
</html>
