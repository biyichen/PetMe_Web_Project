<!DOCTYPE html>

<?php


ini_set('display_errors',1);

// Define variables and initialize with empty values
$username = $password = $confirm_password = $adress  = $city = $zipcode=$telphone=$country_code=$ZIPREG=$email =$state="";

$username_err = $password_err = $confirm_password_err = $adress_err=$city_err= $zipcode_err=$telphone_err=$emailErr =$stateErr="";

$Errcode = 0;

$states = array("VA"=>"Virgina","ML"=>"Maryland","DC"=>"District Of Columbia");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["username"])) {
    $username_err = "Name is required";
    $Errcode +=1 ;
  } else {
    $username = test_input($_POST["username"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$username)) {
      $username_err = "Required only letters or white space"; 
       $Errcode += 1 ;
    }
  }}

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
    $Errcode += 1 ;
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid ingredient, example: 123@xxx.xxx";
      $Errcode += 1 ; 
    }
  }

  if (empty($_POST["telphone"])) {
    $telphone_err = "numbers is required";
    $Errcode += 1 ;
  } else {
    $telphone = test_input($_POST["telphone"]);
    if (!preg_match("/^[0-9]+$/",$telphone)) {
      $telphone_err = "Only numbers allowed";
      $Errcode += 1 ; 
    }
  }

 if (empty($_POST["state"])) {
     $stateErr = "State is required";
      $Errcode += 1 ;
  } 
    else {$state = test_input($_POST["state"]);
 
  // Validate password
  if(empty(trim($_POST['password']))){
     $password_err = "Please enter a password."; 
       $Errcode += 1 ;    
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
  if(empty(trim($_POST["confirm_password"]))){
     $confirm_password_err = 'Please confirm password.'; 
       $Errcode += 1 ;    
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }  

    // Validate adress
    if (empty($_POST["adress"])) {
        $adress_err = "Missing the Address";
         $Errcode += 1 ;  
    }
    else {
        $adress = $_POST["adress"];
    }

    // Validate city
    if (empty($_POST["city"])) {
        $city_err = "Missing the City";
         $Errcode += 1 ;  
    }
    else {
        $city = $_POST["city"];
    }

// Validate zipcode
   
	  if (empty($_POST["zipcode"])) {
	    $zipcode_err = "numbers is required";
	    $Errcode += 1 ;
	  } else {
	    $zipcode = test_input($_POST["zipcode"]);
	    if (!preg_match("/^[0-9]+$/",$zipcode)) {
	      $zipcode_err = "Only numbers allowed";
	      $Errcode += 1 ; 
	    }
	  }



  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formOption = $_POST ['state'];

  }
      if($Errcode==0){
        
        if (isset($_POST['submit']))
      { 
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
                            //Stocktransaction
        $sql = "INSERT INTO Users (user_Name, user_password, user_Email, user_Address, user_City, user_Zip, user_Tel) VALUES (?,?,?,?,?,?,?)";

        if( $stmt = $conn->prepare($sql)){
             $stmt->bind_param("sssssss", $username , $password, $email, $adress, $city, $zipcode, $telphone);
             $stmt->execute(); 
             $conn->close();
             header('Location: http://ec2-54-69-58-81.us-west-2.compute.amazonaws.com/displaydata.php',TRUE, 302);
            //rest of code here
        }else{
           //error !! don't go further
           var_dump($conn->error);
        }

      }
    }
}


 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Acme">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/Profile-Edit-Form.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body id="bg" style="background-image:url(&quot;assets/img/guinea pig.jpg&quot;);background-position:center;background-size:cover;background-repeat:no-repeat;width:100%;height:100vh;">
    <nav class="navbar navbar-light navbar-expand-md navigation-clean-search" id="topnav" style="background-color:rgba(255,255,255,0);">
        <div class="container"><a class="navbar-brand" href="#" style="font-family:Akronim, cursive;color:rgb(107,152,239);font-size:50px;">PetMe</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div
                class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="#" style="color:rgb(255,255,255);">Our Service</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="#" style="color:rgb(255,255,255);">Become Owner</a></li>
                </ul>
                <form class="form-inline mr-auto" target="_self">
                    <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                </form><a class="btn btn-light action-button" role="button" href="#">Log in</a></div>
        </div>



    </nav>
    <div id="signup" name="white" style="background-color:rgba(254,253,253,0.28);height:700px;">
    <form method="post" id="signup1" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>E-mail Address</strong></small>
    <div class="form-group <?php echo (!empty($emailErr)) ? 'has-error' : ''; ?>">
     <input type="email" name="email" class="form-control" alue="<?php echo $email; ?>" style="height:20px;">
     <span class="help-block"><?php echo $emailErr; ?></span>
    </div>
    
    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Name</strong></small>
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
    <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" style="height:20px;">
	<span class="help-block"><?php echo $username_err; ?></span>
    </div>

    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Password</strong></small>
    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
    <input type="password" name="password" class="form-control" style="height:20px;">
    <span class="help-block"><?php echo $password_err; ?></span>
	</div>

    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Confirm password</strong></small>
    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
    <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>" style="height:20px;">
    <span class="help-block"><?php echo $confirm_password_err; ?></span>
    </div>


    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Address &nbsp; &nbsp; &nbsp;</strong></small>
    <div class="form-group <?php echo (!empty($adress_err)) ? 'has-error' : ''; ?>">
    <input type="text" name="adress" class="form-control" value="<?php echo $adress; ?>" style="height:20px;">
    <span class="help-block"><?php echo $adress_err; ?></span>
    </div>


    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>City &nbsp; &nbsp;&nbsp;</strong></small>
    <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
    <input type="text" name="city" class="form-control" value="<?php echo $city; ?>" style="height:20px;">
    <span class="help-block"><?php echo $city_err; ?></span>
    </div>


    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>State &nbsp; &nbsp; &nbsp;</strong></small>
    <select name="state">
	<option value="VA">Virgina</option>
	<option value="ML">Maryland</option>
	<option value="DC">District Of Columbia</option>
    </select>	
    <span class="help-block"><?php echo  $stateErr;?></span>


	<small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Zip code &nbsp; &nbsp; &nbsp;</strong></small>
	<div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
	<input id="zipCode" type="zipcode" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>" style= "height:20px;">
	<span class="help-block"><?php echo $zipcode_err; ?></span>
	</div>

	<small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Telephone</strong></small>
	<div class="form-group <?php echo (!empty($telphone_err)) ? 'has-error' : ''; ?>">
	<input type="tel" name="telphone" class="form-control" value="<?php echo $telphone; ?>" style="height:20px;" />
	<span class="help-block"><?php echo $telphone_err; ?></span>
	</div>
	<br/><button class="btn btn-primary" type="submit" style="margin-top:10px;">Submit</button>
	</form>
	</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/zipcode.js"></script>
    
</body>

</html>