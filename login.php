<?php
session_start();
$user_ID = $_POST['user_ID'];
$password = $_POST['password'];

$_SESSION["user_ID"] = $user_ID;

// Database connection
$host = "localhost";
$dbname = "logindb";
$dbuser = "root";
$dbpassword = "";

$conn = mysqli_connect($host, $dbuser, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_ID = $_POST['user_ID'];
    $password = $_POST['password'];

    // Retrieve user from database
    $sql = "SELECT * FROM login_info WHERE user_ID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $user_ID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        // Verify password
        if ($password == $row['password']) {  // Change this to password_verify() if hashing is used
            $_SESSION['user'] = $row['username'];
            header("Location: reserve.html"); // Redirect to dashboard after login
            exit();
        } else {
            echo "Invalid user_ID or password!";
        }
    } else {
        $error = "No account found with this user_ID!";
    }
    
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>