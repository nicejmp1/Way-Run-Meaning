<?php
include "../connect/connect.php";

$sql = "CREATE TABLE attendance (";
$sql .= "id INT AUTO_INCREMENT PRIMARY KEY,";
$sql .= "user_id INT NOT NULL,";
$sql .= "date DATE NOT NULL,";
$sql .= "status ENUM('present', 'absent') NOT NULL,";
$sql .= "UNIQUE KEY (user_id, date)";
$sql .= ") DEFAULT CHARSET=utf8";

if ($connect->query($sql) === TRUE) {
    echo "Table attendance created successfully";
} else {
    echo "Error creating table: " . $connect->error;
}

$connect->close();
?>