<?php
// View/home/payment.php (basic style)
include("../../Model/config.php");
include("../../Controller/auth.php"); // ensure user is logged in

// Check order_id
if (!isset($_GET['order_id'])) {
    echo "<p style='color:red;'>Missing order_id.</p>";
    echo "<p><a href='my_ticket.php'>Back to My Tickets</a></p>";
    exit();
}

$user_id  = $_SESSION['user_id'];
$order_id = intval($_GET['order_id']);

// Basic query to get the order for this user
$sql    = "SELECT * FROM orders WHERE id = $order_id AND user_id = '$user_id' LIMIT 1";
$result = mysqli_query($conn, $sql);
$order  = ($result && mysqli_num_rows($result) > 0) ? mysqli_fetch_assoc($result) : null;

if (!$order) {
    echo "<p style='color:red;'>Order not found.</p>";
    echo "<p><a href='my_ticket.php'>Back to My Tickets</a></p>";
    exit();
}

// If already paid (case-insensitive check)
if (strcasecmp($order['payment_status'], 'Paid') === 0) {
    echo "<p style='color:green;'>This order is already paid.</p>";
    echo "<p><a href='my_ticket.php'>Back to My Tickets</a></p>";
    exit();
}

$amount = $order['total_price'];
$title  = $order['name'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <h1>Payment</h1>

    <p><strong>Event:</strong> <?php echo htmlspecialchars($title); ?></p>
    <p><strong>Amount:</strong> $<?php echo htmlspecialchars($amount); ?></p>

    <!-- Submit to controller to create payment and mark order as Paid -->
    <form method="POST" action="../../Controller/payment_auth.php">
        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

        <label>Payment Method</label><br>
        <select name="method" required>
            <option value="Card">Card</option>
            <option value="Bkash">Bkash</option>
            <option value="Nagad">Nagad</option>
            <option value="Cash">Cash</option>
        </select><br><br>

        <label>Transaction Ref (optional)</label><br>
        <input type="text" name="txn_ref" placeholder="e.g., TXN123456"><br><br>

        <button type="submit" name="pay_submit">Pay Now</button>
    </form>

    <p><a href="my_ticket.php">Back to My Tickets</a></p>
</body>
</html>
