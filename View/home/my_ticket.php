<?php
include("../../Model/config.php");
include("../../Controller/auth.php");
include("../../Model/queries.php");

$user_id = $_SESSION["user_id"];

// ✅ Handle payment simulation
if (isset($_GET['pay_id'])) {
    $order_id = intval($_GET['pay_id']);
    // Update only if the order belongs to this user
    mark_order_paid($conn, $order_id, $user_id);

    // Redirect back to refresh page
    header("Location: my_tickets.php");
    exit();
}

// Fetch user orders with event info
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
                <p><strong>Date:</strong> <?php echo $ticket["event_date"] ?? "N/A"; ?></p>
                <p><strong>Quantity:</strong> <?php echo $ticket["total_tickets"]; ?></p>
                <p><strong>Price:</strong> $<?php echo $ticket["total_price"]; ?></p>
                <p><strong>Status:</strong> <?php echo $ticket["payment_status"]; ?></p>

                <?php if ($ticket["payment_status"] === "Pending"): ?>
                    <a href="../../Controller/payment_auth.php?order_id=<?php echo $ticket['id']; ?>" class="btn">Pay Now</a>
                <?php else: ?>
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
