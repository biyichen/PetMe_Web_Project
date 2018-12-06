
<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8">
  <title>Stock Transaction System</title>
   <link rel="stylesheet" href="displaydata.css" /> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script>
    $( document ).ready(function() {
              $.ajax({
                url: 'data.php',
                dataType: 'json',
                type: 'post',
                success: function(result){
                    
                  var n = result.length;
                  for(var i=0;i<n;i++){
                   // console.log( result[i].id);
                   // console.log( result[i].director);
                   // console.log( result[i].genre);
                   // console.log( result[i].title);
                   console.log("information retrieved");
             
              // $("#querytable").find("tr:gt(1)").empty();
              // $("#querytable").find('tr').slice(2).remove()
              //id, name, email, num, price, currency, state 
              $('#querytable tr:last').after('<tr class="data"><td><a href="table.php?id='+result[i].id+'">'+result[i].id+'</a> </td> <td><a href="table.php?id='+result[i].id+'">'+result[i].name+'</a> </td><td><a href="table.php?id='+result[i].id+'">'+result[i].email+'</a> </td><td><a href="table.php?id='+result[i].id+'">'+result[i].num+'</a> </td><td><a href="table.php?id='+
                result[i].id+'">'+result[i].price+'</a> </td><td><a href="table.php?id='+
                result[i].id+'">'+result[i].currency+'</a> </td><td><a href="table.php?id='+result[i].id+'">'+result[i].state+'</a> </td> <td><a href="motify.php?id='+result[i].id+'">modify</td><td><a href="delete.php?id='+result[i].id+'"> delete</a> </td></tr>]');
              }
                }
              });
              // console.log(finalData);
     
 

});
   
</script>

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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" id = "signup">
      <fieldset>
        <legend>User Input Feilds</legend>



  <table id="querytable">
    <tr><th>ID</th><th>Name</th> <th>Email</th><th>Number</th><th>Price</th><th>Currency</th><th>State</th><th></th><th></th></tr>
    
    <tr><td></td> <td></td> <td></td> <td></td> <td></td> <td></td>  <td></td> <td></td><td></td></tr>

  </table>
  </fieldset>
<div class="footer">
    <p><a href="homepage.html">Home</a> | <a href="#">About us</a> | <a href="#">Contract us</a></p>
    <p><em>Copyright &copy; 2016 Turbo Zone</em></p>
</div>
</body>

</html>