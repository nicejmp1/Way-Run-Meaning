<?php
include "../connect/connect.php";

$sql = "CREATE TABLE blog (";
$sql .= "blogID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
$sql .= "memberID INT(10) NOT NULL,";
$sql .= "blogTitle VARCHAR(100) NOT NULL,";
$sql .= "blogCont LONGTEXT NOT NULL,";
$sql .= "blogCate VARCHAR(20) NOT NULL,";
$sql .= "blogAuthor VARCHAR(20) NOT NULL,";
$sql .= "blogRegTime INT(11) NOT NULL,";
$sql .= "blogView INT(10) DEFAULT 0,";
$sql .= "blogLike INT(10) DEFAULT 0,";
$sql .= "blogImgFile VARCHAR(100) DEFAULT NULL,";
$sql .= "blogImgSize VARCHAR(100) DEFAULT NULL,";
$sql .= "blogModTime INT(11) DEFAULT NULL,";
$sql .= "blogDelete TINYINT(1) DEFAULT 1";
$sql .= ") CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($connect->query($sql) === TRUE) {
    echo "Table 'blog' created successfully.";
} else {
    echo "Error creating table: " . $connect->error;
}

$connect->close();
?>