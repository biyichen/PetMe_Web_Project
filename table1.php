<?php
error_reporting(E_ALL);

ini_set('display_errors', 1);
$id = $_GET["id"];

//----------------------------------------RETRIEVE RECORDS - DATABASE--------------------------------------------------
//Obtain login credentials
//$Id = $_GET['id'];
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



//Retrieve records
$query  = "SELECT * FROM Users where user_ID = ?" ;

$stmt = $conn->prepare($query);
echo "[debug]user_ID is: ". $user_ID ;    
$stmt->bind_param("i", $user_ID);
$success= $stmt->execute();

 $stmt->bind_result($user_ID,  $user_Name , $user_password);

$stmt->fetch();


//Close connection
$conn->close();

?>


<!DOCTYPE HTML>  
<html>

<head lang="en">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  <title>Stock Transaction System</title>
   <link rel="stylesheet" href="homepage2.css" /> 
   <link rel="stylesheet" href="displaydata.css" /> 
   <script type="text/javascript" language="javascript" src="userinputvalidate.js"></script> 
</head>
<body>


<div class="header">
  <h1>Stock Market</h1>
</div>

<div class="row">

<div class="col-3 col-m-3 menu">
  <ul>
    <li><a href="homepage2.html">Home</a></li>
    <li><a href="http://ec2-54-69-58-81.us-west-2.compute.amazonaws.com/project2/displaydata.php">Review Records</a></li>
    <li><a href="http://ec2-54-69-58-81.us-west-2.compute.amazonaws.com/project2/userinput.php">Register</a></li>
    <li><a href="#">Companies</li>
  </ul>
</div>
  <title>User Input</title>
  <h4>Welcome to Stock Market</h4>
  <aside>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id = "signup1">
      <fieldset>
        <legend>User Input Feilds</legend>  

<h3>Record</h3>
 <center>
  <table border="1" width="80%">
    <tr>
      <center><td>name: </td>
      <td><?php echo $user_Name;?></td>
    <tr>
      <td>password: </td>
      <td><?php echo $user_password;?></td>
    </tr>
     


</table>
</fieldset>
<div class="footer">
  <p><a href="homepage.html">Home</a> | <a href="#">About us</a> | <a href="#">Contract us</a></p>
  <p><em>Copyright &copy; 2016 Turbo Zone</em></p>
</div>
</body>
</html>