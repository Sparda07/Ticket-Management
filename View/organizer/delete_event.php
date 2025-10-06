<?php
include("../../Controller/org_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

$id = $_GET["id"];

if (delete_event($conn, $id)) {
    header("Location: organizer_dashboard.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
<!DOCTYPE html>
<html>
<head></head>
<body>
    <a href="../Reg/logout.php">Logout</a>
</body>
</html>
