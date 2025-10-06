<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

// Fetch all orders
$result = get_all_orders($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
</head>
<body>

<h1>Manage Orders</h1>
<p>Welcome, <strong><?php echo $_SESSION["username"]; ?></strong></p>
<hr>

<a href="admin_dashboard.php">⬅ Back to Dashboard</a>
<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Quantity</th>
        <th>Total Price</th>
        <th>Order Date</th>
        <th>Status</th>
    </tr>

    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row["id"]; ?></td>
                <td><?php echo $row["user_id"]; ?></td>
                <td><?php echo $row["total_tickets"]; ?></td>
                <td><?php echo $row["total_price"]; ?></td>
                <td><?php echo $row["placed_on"]; ?></td>
                <td><?php echo $row["payment_status"]; ?></td>
            </tr>
        <?php endwhile; ?>
    <?php else: ?>
        <tr><td colspan="6">No orders found.</td></tr>
    <?php endif; ?>

</table>

</body>
</html>
