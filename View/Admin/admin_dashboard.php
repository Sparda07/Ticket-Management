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

<h1>Admin Dashboard</h1>
<p>Welcome, <strong><?php echo $_SESSION["username"]; ?></strong></p>


<?php
$total_users  = count_users($conn);
$total_orgs   = count_organizers($conn);
$total_events = count_events($conn);
$total_orders = count_orders($conn);
?>

<h3>Summary</h3>
<ul>
    <li>Total Users: <?php echo $total_users; ?></li>
    <li>Total Organizers: <?php echo $total_orgs; ?></li>
    <li>Total Events: <?php echo $total_events; ?></li>
    <li>Total Orders: <?php echo $total_orders; ?></li>
</ul>

<hr>
<h3>Quick Links</h3>
<ul>
    <li><a href="manage_users.php">Manage Users</a></li>
    <li><a href="manage_organizers.php">Manage Organizers</a></li>
    <li><a href="manage_events.php">Manage Events</a></li>
    <li><a href="manage_orders.php">Manage Orders</a></li>
</ul>

<a href="../Reg/logout.php">Logout</a>

</body>
</html>
