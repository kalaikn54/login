<?php

   session_start();
   $conn = mysqli_connect('localhost', 'root', '', 'race');
   if(mysqli_connect_error())
   {
      echo "<p>Error in connection to database.</p>";
      exit();
   }
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
    
      if(isset($_POST["logout"]))
      {
     
         session_destroy();
     
         header("location:index.php");
      
         exit();
      }
      $username = $password = "";
      $username = $_POST["username"];
      $username = filter_login_input($username);
      $password = $_POST["password"];
      $password = filter_login_input($password);
      $qry = "select * from academy where username='$username' and password='$password'";
      $res = $conn->query($qry);
      if(mysqli_num_rows($res)>0)
      {
         $_SESSION['login'] = $username;
      }
      else 
      {
         $loginCheck = "No";
      }
   }
   function filter_login_input($loginData)
   {
      $loginData = trim($loginData);
      $loginData = stripslashes($loginData);
      $loginData = htmlspecialchars($loginData);
      return $loginData;
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>login</title>
    <style>
 body{background-color:black;}
.form{background-image:url(../loginpage/istockphoto-1039365130-612x612.jpg);
   background-repeat: no-repeat;height: 1200px;margin-left:500px;}
.form input{margin-left:230px;transform: translateY(1000%);border-radius:5px;padding: 7px;}
.form h1{margin-left:230px;transform: translateY(950%)}
.form u{transform: translateY(1400%)}
.logo{background-image:url(../loginpage/login-logo.jpg) ;background-repeat: no-repeat;}
.footer{transform: translateY(3200%);}
       </style>
    <script>
   function checkBeforeLogin()
   {
      if(document.loginForm.username.value=="")
      {
         alert("Enter Username");
         document.loginForm.username.focus();
         return false;
      }
      if(document.loginForm.password.value=="")
      {
         alert("Enter Your Password");
         document.loginForm.password.focus();
         return false;
      } 
      return true;
   }
   </script>
</head>
<body>
    
    <div class="login">
        <div class="content2">
        <?php
           
   if(isset($_SESSION['login']))
   {
      echo "<p>You are successfully logged in.</p>";
      echo "<p>Now you can access the admin page.</p>";
      echo "<form method=\"post\">";
      echo "<input type=\"submit\" name=\"logout\" value=\"LogOut\">";
      echo "</form>";

      exit();
   }
?>
<div class="form">
   <div class="logo">
  <h1>LOGIN</h1>
   <form name="loginForm" method="post" onSubmit="return checkBeforeLogin()">
      
   <input name="username" type="text" placeholder="enter username" maxlength="40" required><br/>
   <input name="password" type="password" placeholder="enter password" maxlength="40" required><br/>
   <?php
      if(isset($loginCheck))
      {
         echo "Invalid data<br/>";
      }
   ?>
   <div class="submit">


   <input type="submit" name="login" value="LogIn">
   <div class="footer">
   <p> Copyright © 2020 - 2025
Genuine Infotech Private Limited<p>
</div>

   <u> <a href="signup.php">To Create Account </a></u>
   



   </div>
   </div>
   </form>

 
    </div>
    
    </div>


</body>
</html>