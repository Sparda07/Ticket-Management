<?php
// Controller/payment_auth.php
session_start();

// ✅ Check user authentication (like Controller/auth.php)
if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "user" || !isset($_SESSION["user_id"])) {
    header("Location: ../View/Reg/login.php");
    exit();
}

require_once("../Model/config.php");
require_once("../Model/queries.php");

$user_id = $_SESSION["user_id"];

/* ------------------ SHOW PAYMENT FORM (GET) ------------------ */
if ($_SERVER["REQUEST_METHOD"] === "GET") {

    // ✅ Validate order_id
    if (!isset($_GET['order_id'])) {
        echo "<p style='color:red;'>Missing order_id.</p>";
        echo "<p><a href='../View/home/my_ticket.php'>Back to My Tickets</a></p>";
        exit();
    }

    $order_id = intval($_GET['order_id']);

    // ✅ Make sure this order belongs to the logged-in user
    $order = get_order_for_user($conn, $order_id, $user_id);
    if (!$order) {
        echo "<p style='color:red;'>Order not found.</p>";
        echo "<p><a href='../View/home/my_ticket.php'>Back to My Tickets</a></p>";
        exit();
    }

    // ✅ If already paid, show message
    if ($order['payment_status'] === 'Paid') {
        echo "<p style='color:green;'>This order is already paid.</p>";
        echo "<p><a href='../View/home/my_ticket.php'>Back to My Tickets</a></p>";
        exit();
    }

    // ✅ Show payment form
    $amount = htmlspecialchars($order['total_price']);
    $title  = htmlspecialchars($order['name']);

    echo "<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link rel='stylesheet' href='../View/home/CSS/style.css'>
</head>
<body>
    <h1>Payment</h1>
    <p><strong>Event:</strong> {$title}</p>
    <p><strong>Amount:</strong> \${$amount}</p>

    <form method='POST' action='payment_auth.php'>
        <input type='hidden' name='order_id' value='{$order_id}'>

        <label>Payment Method</label><br>
        <select name='method' required>
            <option value='Card'>Card</option>
            <option value='Bkash'>Bkash</option>
            <option value='Nagad'>Nagad</option>
            <option value='Cash'>Cash</option>
        </select><br><br>

        <label>Transaction Ref (optional)</label><br>
        <input type='text' name='txn_ref' placeholder='e.g., TXN123456'><br><br>

        <button type='submit' name='pay_submit'>Pay Now</button>
    </form>

    <p><a href='../View/home/my_ticket.php'>Back to My Tickets</a></p>
</body>
</html>";
    exit();
}

/* ------------------ PROCESS PAYMENT (POST) ------------------ */
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['pay_submit'])) {
    $order_id = intval($_POST['order_id']);
    $method   = $_POST['method'] ?? 'Card';
    $txn_ref  = $_POST['txn_ref'] ?? '';

    // ✅ Validate order belongs to user
    $order = get_order_for_user($conn, $order_id, $user_id);
    if (!$order) {
        echo "<p style='color:red;'>Order not found.</p>";
        echo "<p><a href='../View/home/my_ticket.php'>Back to My Tickets</a></p>";
        exit();
    }

    // ✅ If already paid, redirect
    if ($order['payment_status'] === 'Paid') {
        header("Location: ../View/home/my_ticket.php");
        exit();
    }

    // ✅ Create payment record
    $payment_id = create_payment_initiated($conn, $order_id, $user_id, $order['total_price'], $method);
    if (!$payment_id) {
        echo "<p style='color:red;'>Could not start payment.</p>";
        echo "<p><a href='payment_auth.php?order_id=$order_id'>Back to payment</a></p>";
        exit();
    }

    // ✅ Simulate payment success
    $ok = finalize_payment($conn, $payment_id, 'Success', $txn_ref);
    if ($ok) {
        header("Location: ../View/home/my_ticket.php");
        exit();
    } else {
        echo "<p style='color:red;'>Payment failed. Try again.</p>";
        echo "<p><a href='payment_auth.php?order_id=$order_id'>Back to payment</a></p>";
        exit();
    }
}

// Fallback redirect if accessed incorrectly
header("Location: ../View/home/my_ticket.php");
exit();
?>
