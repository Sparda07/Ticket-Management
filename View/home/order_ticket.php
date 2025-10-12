<?php
include("../../Model/config.php");
include("../../Controller/auth.php");
include("../../Model/queries.php");


$result = get_active_events($conn);


if (isset($_GET['order_id'])) {
    $event_id = intval($_GET['order_id']);
    $user_id  = $_SESSION['user_id'];

    
    create_order_for_event($conn, $user_id, $event_id);

    header("Location: my_ticket.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Tickets</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class = "header"><h3 class="admin-header">Order Tickets</h1></div>


    <div class="box-container">
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
            <?php while ($event = mysqli_fetch_assoc($result)): ?>
                <div class="box">
                    <h3><?php echo htmlspecialchars($event["title"]); ?></h3>
                    <p><strong>Location:</strong> <?php echo htmlspecialchars($event["location"]); ?></p>
                    <p><strong>Date:</strong> <?php echo $event["event_date"]; ?></p>
                    <p><strong>Price:</strong> $<?php echo htmlspecialchars($event["price"]); ?></p>
                    <div><a href="?order_id=<?php echo $event['event_id']; ?>" class="btn">Order Ticket</a></div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No events available!</p>
        <?php endif; ?>
    </div>
    <div class = "user-header"><a href = "home.php" class = "btn back"> Back Home </a></div>

</body>
</html>
