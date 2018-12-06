<!DOCTYPE html>
<?php
require_once 'config.php';

// Define variables and initialize with empty values
$email=$username = $password = $confirm_password = $adress = $valid_adress = $city = $valid_city= $zipcode=$valid_zipcode=$telphone=$country_code=$ZIPREG="";
$email_err=$username_err = $password_err = $confirm_password_err = $adress_err=$city_err= $zipcode_err=$telphone_err="";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT user_ID FROM User WHERE user_Name = ?";
        
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    // Validate adress
    if (empty($_POST["email"])) {
        $email_err = "Missing the email";
    }
    else {
        $email = $_POST["email"];
    }
    
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }
    
    // Validate adress
    if (empty($_POST["adress"])) {
        $adress_err = "Missing the Address";
    }
    else {
        $adress = $_POST["adress"];
    }

    // Validate city
    if (empty($_POST["city"])) {
        $city_err = "Missing the City";
    }
    else {
        $city = $_POST["city"];
    }

// Validate zipcode
 	if (empty($_POST["zipcode"])) {
        $zipcode_err = "Please enter the zip code";
    	
   		 }	
   	else if(!preg_match("/^[0-9]{5}$/", $_POST['zipcode'])){
    		$zipcode_err="wrong form";
    	}
    	else {
        $zipcode = $_POST["zipcode"];
   	 }
 
	
// Validate telphone
    $telphone = stripslashes($_POST['telphone']);

	if(!$telphone || $telphone == "Phone Number*")
	{
	$telphone_err .= "Please enter your phone number.<br />";
	} 

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO User (user_Name, user_password,user_Email,
        user_Address,user_City,user_State,user_Zip,user_Tel) VALUES (?,?,?,?,?,?,?,?)";
         
        if($stmt = mysqli_prepare($conn, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssssss", $param_username, $param_password,$param_email
            ,$param_address,$param_city,$param_state,$param_zip,$param_tel);
            
            // Set parameters
            $param_email=$email;
            $param_username = $username;
            $param_password = $password; // Creates a password hash
            $param_address= $adress;
            $param_city=$city;
            $param_state=$_POST["state"];
            $param_zip=$zipcode;
            $param_tel=$telphone;
            
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($conn);
}

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
   
</head>

<body id="bg" style="background-image:url(&quot;assets/img/guinea pig.jpg&quot;);background-position:center;background-size:cover;background-repeat:no-repeat;width:100%;height:130vh;">
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
                </form><a class="btn btn-light action-button" role="button" href="login.php">Log in</a></div>
        </div>

	<?php
	ini_set('display_errors',1);


	?>

    </nav>
    <div class="login-clean" id="signup" name="white" style="background-color:rgba(241,247,252,0);padding:40px;">
    <form method="post" style="background-color:rgba(255,255,255,0.65);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    <small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>E-mail Address</strong></small>
    <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
    <input type="email" name="email" style="height:20px;" class="form-control" value="<?php echo $email; ?>">
    <span class="help-block"><?php echo $email_err; ?></span>
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
    <select name="state" value="<?php echo $state;?>">
	<option value="DC">District Of Columbia</option>
	<option value="MD">Maryland</option>
	<option value="VA">Virginia</option>
	<option value="WV">West Virginia</option>
    </select>				

	<small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Zip code &nbsp; &nbsp; &nbsp;</strong></small>
	<div class="form-group <?php echo (!empty($zipcode_err)) ? 'has-error' : ''; ?>">
	<input id="zipCode" type="text" name="zipcode" class="form-control" value="<?php echo $zipcode; ?>" style= "height:20px;">
	<span class="help-block"><?php echo $zipcode_err; ?></span>
	</div>

	<small class="form-text text-muted" style="font-family:Acme, sans-serif;"><strong>Telephone</strong></small>
	<div class="form-group <?php echo (!empty($telphone_err)) ? 'has-error' : ''; ?>">
	<input type="tel" name="telphone" class="form-control" value="<?php echo $telphone; ?>" style="height:20px;" />
	<span class="help-block"><?php echo $telphone_err; ?></span>
	</div>
	<div class="form-group">
	<button class="btn btn-primary btn-block" type="submit" style="margin-top:10px;">Submit</button>
	</div>
	</form>
	</div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/zipcode.js"></script>
    
</body>

</html>