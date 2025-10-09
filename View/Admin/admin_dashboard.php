<?php
include("../../Controller/admin_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet"  href="../CSS/style.css">
</head>
<body>
    <header class = "header">
        <h3 class = "header">Admin Dashboard</h1>
        <p class = "paragraph">Welcome, <strong><?php echo $_SESSION["username"]; ?></strong></p>
    </header>


    <?php
        $total_users  = count_users($conn);
        $total_orgs   = count_organizers($conn);
        $total_events = count_events($conn);
        $total_orders = count_orders($conn);
    ?>

    <section class = "summary-card">
        <h3 class = "admin-header">Event Ticket Summary</h3> <br><br>
        <table class = "summary-list">
            <tr>
                <th>Total Users</th>
                <th>Total Organizers</th>
                <th>Total Events</th>
                <th>Total Orders</th>
            </tr>

             <tr>
                <td><?php echo $total_users; ?></td>
                <td><?php echo $total_orgs; ?></td>
                <td><?php echo $total_events; ?></td>
                <td><?php echo $total_orders; ?></td>
            </tr>

            <tr class = "a">
                <td><a href="manage_users.php">Manage Users</a></td>
                <td><a href="manage_organizers.php">Manage Organizers</a></td>
                <td><a href="manage_events.php">Manage Events</a></td>
                <td><a href="manage_orders.php">Manage Orders</a></td>
            </tr>

        </table>

            
    </section>
    <div class = "summary-card"><a href="../Reg/logout.php" class = "delete-btn">Logout</a></div>
</body>
</html>
