<!DOCTYPE html>
<?php

require_once 'config.php';

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } 
    
    else{
        $username = $_POST["username"];
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } 
    else{
        $password = $_POST['password'];
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err))
    {
        // Prepare a select statement
        $sql = "SELECT user_Name, user_password, user_ID FROM User WHERE user_Name = ? ";
        
        if($stmt = mysqli_prepare($conn, $sql))
        {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                $hashpword= md5($password);
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $username, $dbpassword, $userID);
                    if(mysqli_stmt_fetch($stmt)){
                        if($password==$dbpassword){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['ID'] = $userID;      
                            header("location: postService.php");
                        	} 
                        else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        	}
                    }
                } 
                else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                	}
            } 
            else{
                echo "Oops! Something went wrong. Please try again later.";
            	}
        }
        else 
        {
        echo "<script>alert('fail to submit！'); history.go(-1);</script>";
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
    <title>login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/ionicons.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
</head>

<body style="background-image:url(&quot;assets/img/bg3.jpg&quot;);margin:0 auto;background-position:center;background-size:cover;background-repeat:no-repeat;width:100%;height:100vh;">
    <div>
        <nav class="navbar navbar-light navbar-expand-md navigation-clean" style="background-color:rgba(255,255,255,0);">
            <div class="container"><a class="navbar-brand" href="#" style="font-size:50px;color:rgb(107,152,239);font-family:Akronim, cursive;">PetMe</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"></button>
                <div class="collapse navbar-collapse"
                    id="navcol-1"></div>
            </div>
        </nav>
    </div>
    <div class="login-clean" style="background-color:rgba(241,247,252,0);padding:40px;">
        <form method="post" id="login" style="background-color:rgba(255,255,255,0.65);" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-paw" style="color:rgb(208,44,93);"></i></div>
            <label>Username</label>
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <label>Password</label>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
            <button class="btn btn-primary btn-block" type="submit" value="login" style="color:rgb(245,245,245);background-color:rgb(208,44,93);">
            Log In
            </button>
            </div>
            <p>Don't have an account? <a href="signup.php">Sign up now</a>.</p>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>