<?php
include("../../Model/config.php");
include("../../Controller/auth.php");
include("../../Model/queries.php");

$user_id = $_SESSION["user_id"];

// Handle ticket cancellation
if (isset($_GET['cancel_id'])) {
    $order_id = intval($_GET['cancel_id']);
    cancel_order($conn, $order_id, $user_id);
    header("Location: cancel_ticket.php");
    exit();
}

// Fetch user orders (with event info)
$result = get_user_orders_with_event($conn, $user_id);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cancel Tickets</title>
    <link rel="stylesheet" href="style_order.css">
</head>
<body>

<h1 class="title">Cancel Tickets</h1>

<div class="box-container">
    <?php if ($result && mysqli_num_rows($result) > 0): ?>
        <?php while ($ticket = mysqli_fetch_assoc($result)): ?>
            <div class="box">
                <h3><?php echo htmlspecialchars($ticket["name"]); ?></h3>
                <p><strong>Location:</strong> <?php echo htmlspecialchars($ticket["location"] ?? "N/A"); ?></p>
                <p><strong>Date:</strong> <?php echo $ticket["event_date"] ?? "N/A"; ?></p>
                <p><strong>Quantity:</strong> <?php echo $ticket["total_tickets"]; ?></p>
                <p><strong>Price:</strong> $<?php echo $ticket["total_price"]; ?></p>
                <p><strong>Status:</strong> <?php echo $ticket["payment_status"]; ?></p>

                <?php if ($ticket["payment_status"] === "Pending"): ?>
                    <a href="?cancel_id=<?php echo $ticket['id']; ?>" class="btn">Cancel Ticket</a>
                <?php else: ?>
                    <button class="btn" disabled>Cannot Cancel</button>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No tickets found!</p>
    <?php endif; ?>
</div>

</body>
</html>
