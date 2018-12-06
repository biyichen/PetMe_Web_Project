<?php
ini_set('display_errors',1);

$servername = "localhost";
$username = "root";
$password = "DbSih4IUGfVP";
$dbname = "PetMe";


// Create connection
$conn = new mysqli($servername, $username, $password, $Databasename);

// Check connection
 if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}

 

$sql = "SELECT user_ID, user_Name, user_password FROM Users";


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

  $emparray = array();
  
    while($row =mysqli_fetch_assoc($result))
    {
        $emparray[] = $row;
    }
//    array_push($emparray, Array ( 'id' => $val1 , 'director' => $val2 ,'genre' => $val3, 'title' => $val4 ));
    // print_r($emparray);
     echo json_encode($emparray);

} else {
    echo "0 results";
}



$conn->close();
function IsNullOrEmptyString($question){
    return (!isset($question) || trim($question)==='');
}

 ?>

