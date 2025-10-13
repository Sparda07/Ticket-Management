<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

$result = get_all_orders($conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Manage Orders</title>
    <link rel = "stylesheet" href = "../CSS/style.css">
</head>
<body>

    <div class= "rolling-section" >
        <header class = "header">
            <h1 class = "admin-header">Manage Orders</h1>
        </header>

         <div class = "back-div"><a href="admin_dashboard.php" class = "delete-btn back">⬅ Back to Dashboard</a> </div>
    </div>
        
    <div class = "header">

        <table border="1" cellpadding="10" cellspacing="0" class = "manage-organizer-table">
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

    </div>



</body>
</html>
