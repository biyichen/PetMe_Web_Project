<?php

ini_set('display_errors',1);
$servername = "localhost";
$username = "root";
$password = "DbSih4IUGfVP";
$dbname = "PetMe";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "CREATE TABLE `Service` (
  `service_ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_ID` int(11) NOT NULL,
  `petType` varchar(45) NOT NULL,
  `maxAge` int(11) DEFAULT NULL,
  `sizePrefer` varchar(45) DEFAULT NULL,
  `startDate` varchar(30) NOT NULL,
  `endDate` varchar(30) NOT NULL,
  `dailyPrice` decimal(10,0) NOT NULL,
  PRIMARY KEY (`service_ID`),
  KEY `fk_user_ID` (`user_ID`),
  CONSTRAINT `fk_user_ID` FOREIGN KEY (`user_ID`) REFERENCES `PetMe`.`User` (`user_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
"
;

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
