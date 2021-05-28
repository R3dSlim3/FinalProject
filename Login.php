<!DOCTYPE HTML>  
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./Styles/Style.css">

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous"> 
</head>
<!-- Body Content -->
<body>  
    <!-- Start Here!!! -->

<!-- TEST CODE -->
<?php
// define variables and set to empty values
$Username= $Password ="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Username = Data($_POST["USERNAME"]);
    $Password = Data($_POST["PASSWORD"]);
}

function Data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
        return $data;
}
?>

<!-- LOGIN PHP -->
<?php
   include("./Connection/connect-db.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $Username = mysqli_real_escape_string($con,$_POST['USERNAME']);
      $Password = mysqli_real_escape_string($con,$_POST['PASSWORD']); 
      
      $sql = "SELECT id FROM admin WHERE USERNAME = '$Username' and PASSWORD = '$Password'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         session_register("myusername");
         $_SESSION['login_user'] = $Username;
         
         header("location: Home.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>

<!-- TEST CODE -->

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?> ">
<!-- Card Body Content -->
<div class="card container-fluid text-center mx-auto" style="width: 50rem;">
    <div class="card-header">
    Login Account:
    </div>
    <div class="card-body">
        <h5 class="card-title">Login Page Account</h5>
        <!-- Insert Login Account -->
        <!-- Form Button Account -->
            <!-- Insert Text Code -->
            <!-- USERNAME -->
        <div class="TextBody">
            <div class="form-group">
                <label for="exampleInputEmail1">Username:</label>
                <div class="TextBox mx-auto container-fluid">
                    <input type="text" class="form-control text-center" id="InputUser" name="USERNAME" placeholder="Enter UserName">
                </div>
            </div>
        </div>
        <!-- PASSWORD -->
        <div class="TextBody">
            <div class="form-group">
                <label for="exampleInputEmail1">Password:</label>
                <div class="TextBox mx-auto container-fluid">
                    <input type="text" class="form-control text-center" id="InputPass" name="PASSWORD" placeholder="Enter Password">
                </div>
            </div>
        </div>
            <!-- Insert Text Stops Here -->
            <div class="ButtonContainer mx-auto container-fluid">
                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </div>
        
    </div>
    <div class="card-footer text-muted">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus dolor.
    </div>
</div>
<!-- End of Card Body Content -->
<!-- BootStrap Script Content -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
    </form>
</body>



</html>