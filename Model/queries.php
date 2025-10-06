<?php
/* ---------------- Accounts (used by login/registration) ---------------- */
function get_account_by_email($conn, $role, $email) {
    if ($role == "user") {
        $sql = "SELECT * FROM users WHERE email = '$email'";
    } elseif ($role == "event_org") {
        $sql = "SELECT * FROM event_orgs WHERE email = '$email'";
    } elseif ($role == "admin") {
        $sql = "SELECT * FROM admins WHERE email = '$email'";
    } else {
        return null;
    }

    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return null;
    }
}

function create_account($conn, $role, $name, $hash, $email, $phone, $address) {
    if ($role == "user") {
        $sql = "INSERT INTO users (username, password, email, phone, address)
                VALUES ('$name', '$hash', '$email', '$phone', '$address')";
    } elseif ($role == "event_org") {
        $sql = "INSERT INTO event_orgs (org_name, password, email, phone, address)
                VALUES ('$name', '$hash', '$email', '$phone', '$address')";
    } elseif ($role == "admin") {
        $sql = "INSERT INTO admins (admin_name, password, email, phone, address)
                VALUES ('$name', '$hash', '$email', '$phone', '$address')";
    } else {
        return false;
    }

    return mysqli_query($conn, $sql);
}

/* ---------------- Organizer event queries (basic) ---------------- */
function get_events_by_org($conn, $org_id) {
    $sql = "SELECT * FROM events WHERE org_id = $org_id";
    return mysqli_query($conn, $sql);
}

function get_event_by_id($conn, $event_id) {
    $sql = "SELECT * FROM events WHERE event_id = $event_id";
    $res = mysqli_query($conn, $sql);
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res);
    }
    return null;
}

function create_event($conn, $org_id, $title, $description, $category, $price, $tickets, $date, $location) {
    $sql = "INSERT INTO events (org_id, title, description, category, price, total_tickets, event_date, location)
            VALUES ('$org_id', '$title', '$description', '$category', '$price', '$tickets', '$date', '$location')";
    return mysqli_query($conn, $sql);
}

function update_event($conn, $event_id, $title, $description, $category, $price, $tickets, $date, $location, $status) {
    $sql = "UPDATE events SET 
                title='$title',
                description='$description',
                category='$category',
                price='$price',
                total_tickets='$tickets',
                event_date='$date',
                location='$location',
                status='$status'
            WHERE event_id=$event_id";
    return mysqli_query($conn, $sql);
}

function delete_event($conn, $event_id) {
    $sql = "DELETE FROM events WHERE event_id = $event_id";
    return mysqli_query($conn, $sql);
}

/* -------- Organizer event table render (basic, echo-based) -------- */
function display_organizer_events($result) {
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>{$row['title']}</td>";
            echo "<td>{$row['category']}</td>";
            echo "<td>{$row['event_date']}</td>";
            echo "<td>{$row['total_tickets']}</td>";
            echo "<td>{$row['price']}</td>";
            echo "<td>{$row['location']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>
                    <a href='edit_event.php?id={$row['event_id']}'>✏️ Edit</a> |
                    <a href='delete_event.php?id={$row['event_id']}' onclick=\"return confirm('Are you sure?');\">🗑️ Delete</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='8'>No events found.</td></tr>";
    }
}

/* ---------------- User tickets & orders (basic) ---------------- */
function get_active_events($conn) {
    $sql = "SELECT * FROM events WHERE status='Active'";
    return mysqli_query($conn, $sql);
}

function get_user_orders_with_event($conn, $user_id) {
    $sql = "SELECT orders.id, orders.name, orders.total_tickets, orders.total_price, orders.payment_status,
                   events.location, events.event_date
            FROM orders
            LEFT JOIN events ON orders.name = events.title
            WHERE orders.user_id = '$user_id'";
    return mysqli_query($conn, $sql);
}

function mark_order_paid($conn, $order_id, $user_id) {
    $sql = "UPDATE orders SET payment_status='Paid' WHERE id=$order_id AND user_id='$user_id'";
    return mysqli_query($conn, $sql);
}

function create_order_for_event($conn, $user_id, $event_id) {
    $event_res = mysqli_query($conn, "SELECT * FROM events WHERE event_id = $event_id");
    if ($event_res && mysqli_num_rows($event_res) > 0) {
        $event = mysqli_fetch_assoc($event_res);
        $title = $event['title'];
        $price = $event['price'];
        $sql = "INSERT INTO orders (user_id, name, total_tickets, total_price, placed_on, payment_status)
                VALUES ('$user_id', '$title', 1, '$price', NOW(), 'Pending')";
        return mysqli_query($conn, $sql);
    }
    return false;
}

function cancel_order($conn, $order_id, $user_id) {
    $sql = "DELETE FROM orders WHERE id = $order_id AND user_id = '$user_id'";
    return mysqli_query($conn, $sql);
}

/* ===================== ADMIN: queries (basic) ===================== */
/* Counts */
function count_users($conn) {
    $res = mysqli_query($conn, "SELECT * FROM users");
    return $res ? mysqli_num_rows($res) : 0;
}
function count_organizers($conn) {
    $res = mysqli_query($conn, "SELECT * FROM event_orgs");
    return $res ? mysqli_num_rows($res) : 0;
}
function count_events($conn) {
    $res = mysqli_query($conn, "SELECT * FROM events");
    return $res ? mysqli_num_rows($res) : 0;
}
function count_orders($conn) {
    $res = mysqli_query($conn, "SELECT * FROM orders");
    return $res ? mysqli_num_rows($res) : 0;
}

/* Lists */
function get_all_users($conn) {
    return mysqli_query($conn, "SELECT * FROM users");
}
function get_all_organizers($conn) {
    return mysqli_query($conn, "SELECT * FROM event_orgs");
}
function get_all_events($conn) {
    return mysqli_query($conn, "SELECT * FROM events");
}
function get_all_orders($conn) {
    return mysqli_query($conn, "SELECT * FROM orders");
}

/* Deletes (admin actions) */
function admin_delete_user($conn, $user_id) {
    return mysqli_query($conn, "DELETE FROM users WHERE user_id = $user_id");
}
function admin_delete_organizer($conn, $org_id) {
    return mysqli_query($conn, "DELETE FROM event_orgs WHERE org_id = $org_id");
}
function admin_delete_event($conn, $event_id) {
    return mysqli_query($conn, "DELETE FROM events WHERE event_id = $event_id");
}
