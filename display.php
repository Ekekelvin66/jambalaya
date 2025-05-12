<?php
require("db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parking Ticket</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        
        .container {
            width: 80%;
            max-width: 500px;
            background: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        h2 {
            color: #ff9800;
            margin-bottom: 15px;
        }

        .ticket {
            border: 2px solid #ff9800;
            padding: 15px;
            border-radius: 10px;
            margin-top: 10px;
            background: #fffbe6;
        }

        .ticket div {
            font-size: 16px;
            margin: 5px 0;
        }

        .btn-print {
            margin-top: 15px;
            padding: 10px 20px;
            background: #ff9800;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn-print:hover {
            background: #e68900;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Your Parking Ticket</h2>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_ID = $_POST["user_ID"]; 

        $query = "SELECT * FROM `tickets` WHERE `user_ID` = '$user_ID' ORDER BY `reservation_date` DESC LIMIT 1";
        $result = mysqli_query($conn, $query);
      
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="ticket">
                <div><strong>User ID:</strong> <?php echo $row["user_ID"]; ?></div>
                <div><strong>Parking Area:</strong> <?php echo $row["parking_area"]; ?></div>
                <div><strong>Parking Space:</strong> <?php echo $row["parking_space"]; ?></div>
                <div><strong>Vehicle Size:</strong> <?php echo $row["vehicle_size"]; ?></div>
                <div><strong>Reservation Date:</strong> <?php echo $row["reservation_date"]; ?></div>
                <div><strong>Total Fee:</strong> ₦<?php echo number_format($row["total_fee"], 2); ?></div>
            </div>
            <?php
        }
    }
    ?>

    <button class="btn-print" onclick="window.print()">Print Ticket</button>
</div>

</body>
</html>
