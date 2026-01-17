<?php
   session_start();
   include("connection.php");

   $systemName = null;
   $systemPass = null;
   $username = null;
   $password = null;
   $alert = null;
   $alert2 = null;

   $sql = "SELECT * FROM USERS";
   $result = mysqli_query($connection, $sql);

   while($row = mysqli_fetch_array($result)){
     $systemName = $row ['NAME'];
     $systemPass = $row ['PASSWORD'];
   }
   
   if(isset($_POST['login_button']))
   {
    $username = $_POST['username'];
    $pass = $_POST['password'];

    if($systemName == $username && $systemPass == $pass){
      $_SESSION[$systemName] = $username;
      $_SESSION[$systemPass] = $pass;

      header("location: dashboard.php");
    }elseif($username !== $systemName){
      $alert = "<p>Wrong username!";
    }elseif($pass !== $systemPass){
      $alert2 = "<p>Wrong Password";
    }


   }else{
     // echo "button is not set.";
     mysqli_close($connection);
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Page</title>
   <link rel="stylesheet" type="text/css" href="../css/style_login.css">
</head>
<body>
   <div class="container">
      <div class='top-title-container'>
         <div class="top-title">
            <h5>Fayeq Bahram <span>.</span> <span>PHP/Laravel Developer</span></h5> 
         </div> 
      </div>
      <div class="bottom-title-container">
         <div>
            <img class="img" src="../icons/login.png">
            <h1>Admin Login</h1>
            <p>Farmacy Management System</p>
         </div>
      </div>
      <div class="login-container">
         <form class="login-form" action="index.php" method="post">
            <div>
               <p>Username</p>
            </div> 
            <div>
               <input type="input" name="username" recurired>
            </div>
            <div style="margin-top: 8px;">
               <p>Password</p>
            </div>
            <div>
               <input type="password" name="password" required>
            </div>
            <div class="button-container" style="height: 40px;">
               <input type="submit" id="login" name="login_button" value="Login">
               <input type="submit" id="admin_login" name="staff_login" value="Staff Login">
            </div>
            <div style="display: flex; justify-content: center;"><?php echo "<h5 style=' color: red; display: flex;'>". $alert; echo $alert2; ?></div>
         </form>
         
      </div>

      <div class="bottom-text-container">
         <p>@fayeqBaheam - 2025</p>
      </div>
   </div>
</body>
</html>

<?php
   if(isset($_POST['staff_login'])){
      header("location: staff-login.php");
   }

?>