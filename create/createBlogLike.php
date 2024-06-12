<?php
include "../connect/connect.php";

$sql = "CREATE TABLE IF NOT EXISTS likes (";
$sql .= "likeID int(10) UNSIGNED AUTO_INCREMENT,";
$sql .= "user_id int(10) UNSIGNED NOT NULL,";
$sql .= "post_id VARCHAR(255) NOT NULL,";
$sql .= "created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
$sql .= "PRIMARY KEY(likeID),";
$sql .= "FOREIGN KEY (user_id) REFERENCES members(memberID),";
$sql .= "UNIQUE KEY unique_like (user_id, post_id)";
$sql .= ") DEFAULT CHARSET=utf8";

$connect->query($sql);

?>