<!DOCTYPE html>
<html>
<head>
<head lang="en">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Transaction System</title>
  <link rel="stylesheet" href="homepage2.css" /> 
  <link rel="stylesheet" href="userinput.css" />  
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
<?php

?>

<p><span class="error">Fields with * are required.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
<table>
  <tr><td>UserName: </td><td><input type="text" name="name" value="<?php echo $name;?>"></td><td><span class="error">* <?php echo $nameErr;?></span></td></tr>
   
  <tr><td>E-mail: </td><td><input type="text" name="email" value="<?php echo $email;?>"></td><td><span class="error">* <?php echo $emailErr;?></span></td></tr>   

    <tr><td>Phone Number: </td><td><input type="text" name="num" value="<?php echo $num;?>"></td><td><span class="error">* <?php echo $numErr;?></span></td></tr>    

      <tr><td>Stock Price: </td><td><input type="text" name="price" value="<?php echo $price;?>"></td><td> <span class="error">* <?php echo $priceErr;?></span></td></tr>    

        <tr><td>Currency: </td><td><input type="radio" name="currency" <?php if (isset($currency) && $currency=="dollars") echo "checked";?> value="dollars">Dollars<input type="radio" name="currency" <?php if (isset($currency) && $currency=="RMB") echo "checked";?> value="RMB">RMB</td><td><span class="error">* <?php echo $currencyErr;?></span</td></tr>     

     <tr>

      <td>State: </td>
      <td>
      <select name="state">
        <option value=""> </option>
        <option value="AL- Alabama">Alabama</option>

        <option value="AK - Alaska">Alaska</option>

        <option value="AZ - Arizona">Arizona</option>

        <option value="AR - Arkansas">Arkansas</option>

        <option value="CA - California">California</option>

        <option value="CO - Colorado">Colorado</option>

        <option value="CT - Connecticut">Connecticut</option>

        <option value="DE - Delaware">Delaware</option>

        <option value="FL - Florida">Florida</option>

        <option value="GA - Georgia">Georgia</option>

        <option value="HI - Hawaii">Hawaii</option>

        <option value="ID - Idaho">Idaho</option>

        <option value="IL - Illinois">Illinois</option>

        <option value="IN - Indiana">Indiana</option>

        <option value="IA - Lowa">Lowa</option>

        <option value="KS - Kansas">Kansas</option>

        <option value="KY - Kentucky">Kentucky</option>

      </select>
      </td>
      <td><span class="error">* <?php echo  $stateErr;?></span></td></td>
    </tr>
    <tr> <td><input type="submit" name="submit" value="Submit"></td> <td><input type="reset" /></td></tr>
  

</table> 
</form>

       
        <p>
          <label style="color:red; float:right;" >*</label><label style="color:red; float:right;">Require fill out</label>
        </p>

      </fieldset>
  </aside>



<div class="footer">
  <p><a href="homepage.html">Home</a> | <a href="#">About us</a> | <a href="#">Contract us</a></p>
  <p><em>Copyright &copy; 2016 Turbo Zone</em></p>
</div>



</body>
</html>