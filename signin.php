<?php

// Including configuration file for database connection
@include 'functions/config.php';

// Starting a new session
session_start();

// Hiding error messages
ini_set("display_errors",0);

// Checking if the login form has been submitted
if(isset($_POST['submit'])){

   // Escaping special characters from the user inputs to avoid SQL injection
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = ($_POST['password']);
   $cpass = ($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   // Query to select user from the database with the given email and password
   $select = "SELECT * FROM user_reg WHERE email = '$email' AND password = '$pass'";

   // Executing the query
   $result_user = mysqli_query($conn, $select);

   // Checking if the query failed
   if(!$result_user) {
      die("Query failed: " . mysqli_error($conn));
   }

   // Checking if there is at least one row with the given email and password in the database
   if(mysqli_num_rows($result_user) > 0){

      $row = mysqli_fetch_array($result_user);

      // Checking if the user is an admin
      if($row['user_type'] == 'admin'){

         // Setting admin_name session variable and redirecting to the admin dashboard
         $_SESSION['admin_name'] = $row['name'];
         header('location:admin_page/admin_dashboard.php');

      // If the user is not an admin, assuming that the user is a regular user
      }elseif($row['user_type'] == 'user'){

         // Setting user_name session variable and redirecting to the user dashboard
         $_SESSION['user_name'] = $row['name'];
         header('location:index.php');

      }
   }else{
      $error[] = 'Incorrect Email or Password!';
   }
}

// Closing database connection
mysqli_close($conn);
?>
<!-- Starting of HTML Document -->
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/svci.icon.png" type="image/x-icon">
   <title>SVCI COMLAB AN IoT | SIGN IN</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
  <!-- Starting of Form Container -->
    <body>
        <div class="form-container" style="background: linear-gradient(to bottom, #87CEFA, #1E90FF);">
          <form action="" method="post">
            <a href="admin/admin_signin.php"><img src="images/svci.png.png" alt="SVCI LOGO" style="width: 70px; height: 70px;"></a>

              <!-- Login Form Heading -->
              <h3>SVCI ComLab An Internet of Things System | Sign In </a></h3>

               <?php
               // Displaying errors in case of any
               if(isset($error)){
                  foreach($error as $error){
                     echo '<span class="error-msg">'.$error.'</span>';
                  };
               };
               ?>

               <!-- Email and Password input fields -->
               <input type="email" name="email" required placeholder="Enter your Email">
               <input type="password" name="password" required placeholder="Enter your Password">

               <!-- Submit Button -->
               <input type="submit" name="submit" value="login now" class="form-btn">

               <!-- Forgot Password and Sign up links -->
               <p>Forgot your password? <a href="forgot_password.php">Reset here</a></p>
               <p>Don't have an account? <a href="signup.php">Sign up now</a></p>

          </form>
             <!-- Ending of Login Form -->
        </div>
        <!-- Ending of Form Container -->
</body>
</html>
<!-- Ending of HTML Document -->
