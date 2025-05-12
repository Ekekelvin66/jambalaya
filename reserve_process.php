<?php

require("db.php");
session_start();
$user_ID = $_SESSION["user_ID"];



if($_SERVER["REQUEST_METHOD"] == "POST"){
   $park_area = $_POST["park"]; 
    $park_date = $_POST["date"]; 
   $park_space =  $_POST["space"];  
    $park_vehicle = $_POST["vehicle"]; 
    $total_fee = $_COOKIE["total_fee"];
  
    
   $sql = "INSERT INTO `tickets`(`user_ID`, `parking_area`, `parking_space`, `vehicle_size`, `reservation_date`, `total_fee`) VALUES ('$user_ID','$park_area','$park_space','$park_vehicle','$park_date','$total_fee')";
   mysqli_query($conn, $sql);

   
//    if(mysqli_query($conn, $sql)){
//     echo "Successful";
//    }
//    else{
//     echo "Failed";
//    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your ticket</title>
</head>
<style></style>
<body>
    <form action="display.php" method="post">
        <input type="text" name="user_ID" placeholder="user_ID">
        <input type="submit" value="View Ticket">

    </form>
</body>
</html>

<?php



?>