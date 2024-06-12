<?php
include "../connect/connect.php";

$sql = "CREATE TABLE members(";
$sql .= "memberID int(10) UNSIGNED AUTO_INCREMENT,";
$sql .= "youEmail varchar(40) NOT NULL,";
$sql .= "youName varchar(40) NOT NULL,";
$sql .= "youNickName varchar(10) NOT NULL,";
$sql .= "youPass varchar(255) NOT NULL,";
$sql .= "youDelete int(10) DEFAULT 1,";
$sql .= "youModTime TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,";
$sql .= "youRegTime DATETIME DEFAULT CURRENT_TIMESTAMP,";
$sql .= "verification_code VARCHAR(6),";  // 인증 코드 저장을 위한 열
$sql .= "verified TINYINT(1) DEFAULT 0,";  // 인증 상태를 저장하는 열
$sql .= "PRIMARY KEY(memberID)";
$sql .= ") DEFAULT CHARSET=utf8";

$connect->query($sql);
?>