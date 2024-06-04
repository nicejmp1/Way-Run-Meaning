<?php
    include "../connect/connect.php";

    $sql = "CREATE TABLE feed (";
    $sql .= "feedID INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
    $sql .= "memberID INT(10) NOT NULL,";
    $sql .= "feedTitle VARCHAR(100) NOT NULL,";
    $sql .= "feedCont LONGTEXT NOT NULL,";
    $sql .= "feedCate VARCHAR(20) NOT NULL,";
    $sql .= "feedAuthor VARCHAR(20) NOT NULL,";
    $sql .= "feedRegTime INT(11) NOT NULL,";
    $sql .= "feedView INT(10) DEFAULT 0,";
    $sql .= "feedLike INT(10) DEFAULT 0,";
    $sql .= "feedImgFile VARCHAR(100) DEFAULT NULL,";
    $sql .= "feedImgSize VARCHAR(100) DEFAULT NULL,";
    $sql .= "feedModTime INT(11) DEFAULT NULL,";
    $sql .= "feedDelete TINYINT(1) DEFAULT 1";
    $sql .= ") CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    if ($connect -> query($sql) === TRUE) {
        echo "Table 'feed' created successfully.";
    } else {
        echo "Error creating table: " . $connect->error;
    }

    $connect -> close();
?>