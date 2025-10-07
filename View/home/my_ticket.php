<?php
include("../../Model/config.php");
include("../../Controller/auth.php");
include("../../Model/queries.php");

$user_id = $_SESSION["user_id"];

// Fetch user's orders with event details
$result = get_user_orders_with_event($conn, $user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Tickets</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>

<h1 class="title">My Tickets</h1>

<div class="box-container">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($ticket = mysqli_fetch_assoc($result)): ?>
            <div class="box">
                <h3><?php echo htmlspecialchars($ticket["name"]); ?></h3>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($ticket["location"] ?? "N/A"); ?></p>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($ticket["event_date"] ?? "N/A"); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($ticket["total_tickets"]); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($ticket["total_price"]); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars(ucfirst($ticket["payment_status"])); ?></p>

                <?php if (strcasecmp($ticket["payment_status"], "Pending") === 0): ?>
                    <!-- Link to payment page -->
                    <a href="payment.php?order_id=<?php echo $ticket['id']; ?>" class="btn">Pay Now</a>
                <?php else: ?>
                    <!-- Show Paid (disabled button) -->
                    <button class="btn" disabled>Paid</button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tickets found!</p>
    <?php endif; ?>
</div>

</body>
</html>
