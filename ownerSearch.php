<!DOCTYPE html>
<html>
<?php

session_start();

if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit();
    }
    
    require_once 'config.php';
    $pettype=$size=$age=$bdate=$edate=$price="";
    $age_err=$price_err="";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        
        if (empty($_POST["age"])) {
            $age_err = "please entet the max age";
        }
        else {
            $age = $_POST["age"];
        }
        
        if (empty($_POST["price"])) {
            $price_err = "please entet the daily price";
        }
        else {
            $price = $_POST["price"];
            }
            
            $pettype=$_POST["pettype"];
            $size=$_POST["size"];
            $bdate=$_POST["bdate"];
            $edate=$_POST["edate"];
            $ID=$_SESSION['ID'];
        
          
        if(empty($age_err) && empty($price_err)){
            
            //$query = "SELECT petType FROM Service WHERE `petType` LIKE '%".$pettype."%'";
            $sql = "SELECT petType,maxAge,sizePrefer,startDate,endDate,dailyPrice FROM Service WHERE petType = ?";
            if($stmt = mysqli_prepare($conn, $sql))
            { 
                // Bind variables to the prepared statement as parameters
                 mysqli_stmt_bind_param($stmt, "s", $param_pettype);
            
                // Set parameters
                $param_pettype = $pettype;
                // Attempt to execute the prepared statement
                 if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                //$hashpword= md5($size);
                // Check if username exists, if yes then verify
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $dbpettype, $size, $maxAge);
                    if(mysqli_stmt_fetch($stmt)){
                        if($pettype==$dbpettype){
                            session_start();
                            $_SESSION['petType'] = $pettype;
                            $_SESSION['ID'] = $ID;    
                            header("location: ViewTable2.php");
                            }
                            else{
                            // Display an error message if password is not valid
                            echo " valid access";
                            } 
                     }
                } 
                else{
                    // Display an error message if username doesn't exist
                    echo "No data found with that.";
                    }
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
                }
        }
        else 
        {
        echo "<script>alert('fail to search'); history.go(-1);</script>";
        }
        // Close statement
        mysqli_stmt_close($stmt);
      }
       mysqli_close($conn)

  


            //-run  the query agaist the mysql query function 
            //$result=mysql_query($query);
            //-create  while loop and loop through result set
            


            // $result = $conn->query($query);
            // header("location: ViewTable2.php");
               
                // Attempt to execute the prepared statement
        /*   if(!$result){
                    // Redirect to login page
                echo "<script>alert('fail to search'); history.go(-1);</script>";
                } 
                $result->close();
           } */   
        //$conn->close();
          

        


?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Service</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Abhaya+Libre">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Atma">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-image:url(&quot;assets/img/bg 2.jpg&quot;);background-position:center;background-size:cover;background-repeat:no-repeat;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" id="topnavi" style="background-color:rgba(255,255,255,0);">
        <div class="container"><a class="navbar-brand" href="#" style="font-family:Akronim, cursive;font-size:50px;color:rgb(107,152,239);">PetMe</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(255,255,255);">Our Service</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="search.php" style="color:rgb(255,255,255);">Find a sitter</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                </form>
                <a href="#" style="margin-right:10px;color:rgb(12,103,238);">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?> </a>
                
                <a href="logout.php" class="btn btn-light action-button">Sign out</a>

                </div>
        </div>
    </nav>
    <div id="matchSitter">
        <div class="jumbotron" style="background-color:rgba(233,236,239,0.15);height:120px;text-align:left;padding:20px;width:550px;">
            <h1 style="font-family:'Alfa Slab One', cursive;color:rgb(52,204,195);margin:0px;">Animal love</h1>
            <p style="font-size:18px;">Please select the following fields to finish service offering.</p>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="jumbotron" id="sittermatch" style="padding:20px;height:360px;background-color:rgba(233,236,239,0.6);width:550px;">
        <small class="form-text text-muted" style="font-size:18px;font-family:Atma, cursive;color:rgb(0,0,0);">Type of pet &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Size</small>
        <select style="height:35px;width:130px;background-color:rgba(83,141,255,0.64);color:rgb(255,255,255);" 
        name="pettype" value="<?php echo $pettype;?>"><optgroup label="">
            <option value="dog"> Dog</option>
            <option value="cat">Cat</option>
            <option value="fish">Fish</option>
            <option value="repitle">Repitle</option>
            <option value="rodent">Rodent</option>
        </optgroup>
        </select>
        <select style="height:35px;width:130px;background-color:rgba(83,141,255,0.64);color:rgb(255,255,255);margin-left:55px;"
        name="size" value="<?php echo $size;?>">
        <optgroup label="">
            <option value="small">Small</option>
            <option value="medium">Medium</option>
            <option value="large">Large</option>
            <option value="xlarge">X-large</option>
        </optgroup>
        </select>
            <small class="form-text text-muted" style="font-size:18px;font-family:Atma, cursive;color:rgb(0,0,0);">Max Age</small>
                <div class="form-group <?php echo (!empty($age_err)) ? 'has-error' : ''; ?>">
                <input min="0" max="15" type="number" name="age" 
                style="margin-left:0px;width:160px;background-color:rgba(255,255,255,0.65);padding:0px;" 
                value="<?php echo $age; ?>">
                <span class="help-block"><?php echo $age_err; ?></span>
                </div>
            <small class="form-text text-muted" style="font-family:Atma, cursive;font-size:18px;color:rgb(0,0,0);">Available From: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;To: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</small>
                <input value="<?php echo $bdate; ?>" name="bdate" 
                type="date" style="font-family:'Abhaya Libre', serif;background-color:rgba(255,255,255,0.65);width:160px;" required>
                <input value="<?php echo $edate; ?>" name="edate" 
                type="date" style="font-family:'Abhaya Libre', serif;margin-left:25px;width:160px;background-color:rgba(255,255,255,0.65);" required>
            <small class="form-text text-muted" style="font-size:18px;font-family:Atma, cursive;color:rgb(0,0,0);">Price per night ($) &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</small>
                <div class="form-group <?php echo (!empty($price_err)) ? 'has-error' : ''; ?>">
                <input min="0" type="number" name="price" style="background-color:rgba(255,255,255,0.65);width:160px;"
                value="<?php echo $price; ?>">
                <span class="help-block"><?php echo $price_err; ?></span>
                </div>
                        <p></p>
                <button class="btn btn-primary" type="submit" style="height:45px;background-color:rgba(83,141,255,0.64);" 
                value="submit">
                Search service
                </button>
            </div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>