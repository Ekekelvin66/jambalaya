<?php
session_start();

    $username = $_POST['fullname'];
    $email = $_POST['email'];
    $user_ID = $_POST['user_ID'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
// Database connection
$host = "localhost";
$dbname = "logindb";
$dbemail = "root";
$dbpassword = "";

$conn = mysqli_connect($host, $dbemail, $dbpassword, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}else{
    if($confirm_password == $password){
        $stmt = $conn -> prepare("INSERT INTO `login_info`(`user_ID`, `username`, `email`, `password`, `confirm_password`) VALUES (?, ?, ?, ?, ?)");
        $stmt ->bind_param("sssss", $user_ID, $username, $email,  $password, $confirm_password);
        $stmt ->execute();
        $stmt ->close();
        $conn ->close();
        header("location:login.html");
    }else{
        echo "Make sure the passords are the same";
    }

}


?>
