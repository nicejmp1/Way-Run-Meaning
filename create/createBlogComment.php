<?php
include "../connect/connect.php";

$sql = "CREATE TABLE blogComment (";
$sql .= "commentID INT AUTO_INCREMENT PRIMARY KEY,";
$sql .= "blogID INT NOT NULL,";
$sql .= "memberID INT NOT NULL,";
$sql .= "commentName VARCHAR(100) NOT NULL,";
$sql .= "commentText TEXT NOT NULL,";
$sql .= "commentTime INT NOT NULL,";
$sql .= "FOREIGN KEY (blogID) REFERENCES blog(blogID) ON DELETE CASCADE,";
$sql .= "FOREIGN KEY (memberID) REFERENCES members(memberID) ON DELETE CASCADE";
$sql .= ") CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($connect->query($sql) === TRUE) {
    echo "Table 'comment' created successfully.";
} else {
    echo "Error creating table: " . $connect->error;
}

$connect->close();
?>