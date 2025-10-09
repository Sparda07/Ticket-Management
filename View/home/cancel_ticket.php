<?php
include("../../Model/config.php");
include("../../Controller/auth.php");
include("../../Model/queries.php");

$user_id = $_SESSION["user_id"];

// Handle ticket cancellation
if (isset($_GET['cancel_id'])) {
    $order_id = intval($_GET['cancel_id']);

    if (cancel_order($conn, $order_id, $user_id)) {
        echo "<script>alert('Ticket cancelled successfully.'); window.location.href='cancel_ticket.php';</script>";
    } else {
        echo "<script>alert('Failed to cancel ticket.'); window.location.href='cancel_ticket.php';</script>";
    }
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
                <p><strong>Date:</strong> <?php echo htmlspecialchars($ticket["event_date"] ?? "N/A"); ?></p>
                <p><strong>Quantity:</strong> <?php echo htmlspecialchars($ticket["total_tickets"]); ?></p>
                <p><strong>Price:</strong> $<?php echo htmlspecialchars($ticket["total_price"]); ?></p>
                <p><strong>Status:</strong> <?php echo htmlspecialchars($ticket["payment_status"]); ?></p>

                <?php if (strtolower($ticket["payment_status"]) === "pending"): ?>
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
