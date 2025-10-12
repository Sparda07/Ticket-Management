<?php
include("../../Controller/org_auth.php");
include("../../Model/config.php");
include("../../Model/queries.php");

$org_id = $_SESSION["org_id"];
$result = get_events_by_org($conn, $org_id);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Organizer Dashboard</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <section class = "header">
        <h3 class = >Event Orginizer</h3>
        <p class = "paragraph">Welcome,<strong> <?= $_SESSION["username"]; ?> </strong></p>
    </section>

    
    <section>
        
        <div class = "organizer-card"><a href="add_event.php" class = "btn">➕ Add New Event</a>
        <a href="../Reg/logout.php" class = "delete-btn">Logout</a></div>
        <div class = "header">
            <h3>Your Events</h3>
            <table border="1" cellpadding="10" class = "manage-organizer-table ">
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date</th>
                    <th>Tickets</th>
                    <th>Price</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            <?php display_organizer_events($result); ?>
            </table>
        </div>
         
    </section>
       
</body>
</html>
