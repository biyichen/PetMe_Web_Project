<!DOCTYPE html>
<html>
<head lang="en">
   <meta charset="utf-8">
   <meta name="viewport" content="width = device-width" />
   <title>MSIST 6205 Project2 retrieve record</title>
   <link  rel="stylesheet" href="css/project2.css" type="text/css" media="screen and (min-width:1201px)"/>
   <link  rel="stylesheet" href="css/project2-mobile.css" type="text/css" media="screen and (max-width:1200px)"/>
   <script type="text/javascript" language="javascript" src="js/project2.js">
   
   </script>
  
   <style type="text/css">
    
   </style>
</head>

<body>

    <header>
    <div id="welcome">
    <h2>Welcome to Stock Manager</h2>
    </div>
    
    <div id="pp"><!--header navigation section-->
        <ul>
            <li><a href="project2_page1.php">Home</a></li>
            <li><a href="#">News</a></li>
            <li><a href="#">Search</a></li>
            <li><a href="#">About Web</a></li>
            <li id= "log"><a href="#">Login</a>|<a href="#">Sign up</a></li>
        </ul>
    </div>
    </header>


<?php
    $servername = "localhost";
    $username = "root";
    $password = "DbSih4IUGfVP";
    $dbname = "PetMe";
    // Create connection
    $conn = new mysqli($servername, $username, $password,$dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully";
    //$pettype=$size=$bdate=$edate=$price="";
    
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['send'])) {
    //$ID= $_GET['ID'];
    $pettype= $_GET['pettype'];
    $size= $_GET['size'];
    $bdate= $_GET['bdate'];
    $edate= $_GET['edate'];
    $price= $_GET['price'];
    }
    }


    $query = "SELECT * FROM Service WHERE petType = '$pettype'";
    $result = $conn->query($query);
    //$query  = "SELECT * FROM Service";
   // $result = $conn->query($query);
    //check if query succeeded 
    if(!$result)die("Database access failed: " . $conn->error);


//else{
/*if ( isset($_POST['ID'])) {
  $ID = get_post($conn, 'ID');*/

//header("location: ViewTable2.php");
if(!$result){
        // Redirect to login page
  header("location: ownersearch2.php");
           } 
            $result->close();
         




        //dispay retrieved records
if ($result->num_rows > 0) {
     echo "<table><tr>
                  <th>pet Type</th>
                  <th>size Prefer</th>
                  <th>start Date</th>
                  <th>end Date</th>
                  <th>daily Price</th>
                  </tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr>
         <td>".$row["pettype"]."</td>
         <td>".$row["size"]."</td>
         <td>".$row["bdate"]."</td>
         <td>".$row["edate"]."</td>
         <td>".$row["price"]."</td>
         
         </tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}


    //$row=$result -> num_rows;
    //or($j=0; $j<$row; ++$j){
    //$result->data_seek($j);
    //$row=$result->fetch_array(MYSQLI_NUM);
    
    //echo <<<_END
    //<pre>
      //<h1>Record</h1>
      //id $row[0]
      //Trade date $row[1]
      //Stock Exchange $row[2]
      //Ticker Symbol $row[3]
      //Trading price $row[4]
      //Number of Share $row[5]
      //Currency $row[6]
      
    //</pre><br /><br />
    //_END;
    //}
    
    $result->close();

//Close connection
$conn->close();
    
?>


   
    
    <footer>
        <div id="xxx"> <!--footer navigation section-->
        
        <ul>
            <li><a href="project2_page1.php">Home</a></li>
            <li><a href="#">Policy</a></li>
            <li><a href="#">Contact Us</a></li>     
        </ul>
        <p id="share">Share:
            <a href="#"><img src="image/email_16.png" alt="Email this to someone" /></a>
            <a href="#"><img src="image/rss_16.png" alt="Syndicated content" /></a>
            <a href="#"><img src="image/twitter_16.png" alt="Share this on Twitter" /></a>
        </p>
        
    </div>
    <div id="copy">
    <p><em>Copyright &copy; 2017 Project2</em></p>
    </div>
    
    </footer>

    
</body>


</html>