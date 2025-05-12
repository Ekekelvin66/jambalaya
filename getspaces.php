<?php
$host = "localhost";
$dbname = "logindb";
$dbuser = "root";
$dbpassword = "";

$conn = new mysqli($host, $dbuser, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['date']) && isset($_POST['park'])) {
    $date = $_POST['date'];
    $park = $_POST['park'];

    $sql = "SELECT space_number FROM parking_space WHERE park = ? AND (reservation_date IS NULL OR reservation_date != ?) AND is_reserved = 0";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $park, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $available_spaces = [];
    while ($row = $result->fetch_assoc()) {
        $available_spaces[] = $row['space_number'];
    }

    echo json_encode($available_spaces);
}

$conn->close();
?>
