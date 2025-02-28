<?php require '../config/constants.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Food Website</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
    <div class="login text-center">
        <h1 class="text-center">Login</h1>
        <br>  <br>
        <?php
        if(isset($_SESSION['login'])){
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-ms'])){
            echo $_SESSION['no-login-ms'];
            unset($_SESSION['no-login-ms']);
        }
        
        ?>
        <br> 
        <!-- Login Form Starts Here -->
        <form method="POST" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter username" id="username" >
            <br>  <br>
            <label for="pass">Password:</label>
            <input type="password" name="password" placeholder="Enter Password" id="password" >
            <br>  <br>
            <input class="btn-primary" type="submit" value="login" name="login">


        </form>

         <!-- Login Form Ends Here -->
        <p class="text-center">Created by <a href="#"> Mariam Ehab</a></pclass>
    </div>
    
</body>
</html>

<?php
if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password =md5( $_POST["password"]);

    // check user is exist in database
    $sql = "SELECT * FROM admin WHERE password ='$password'  AND username='$username'";
   $result = mysqli_query($connect,$sql);
   $count=mysqli_num_rows($result);
   if($count==1){
       $_SESSION['username']=$username;
       header("location:".SITEURL."admin/index.php");
    
       
   }else{
  $_SESSION['login']="<div class='error'> Login Failed</div>";
  header("location:".SITEURL."admin/login.php");
   }
}



?>
