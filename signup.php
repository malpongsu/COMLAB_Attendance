<?php

// Include database configuration file
@include 'functions/config.php';

        // Check if submit button was clicked
        if(isset($_POST['submit'])){

           // Escape special characters in the inputs and assign to variables
           $name = mysqli_real_escape_string($conn, $_POST['name']);
           $email = mysqli_real_escape_string($conn, $_POST['email']);
           $pass = $_POST['password'];
           $cpass = $_POST['cpassword'];
           $user_type = "user";

           // Check if email already exists in database
           $select = "SELECT email FROM user_db WHERE email = '$email'";
           $result = mysqli_query($conn, $select);

           if(mysqli_num_rows($result) == 0){

              // Check if password and confirm password match
              if($pass == $cpass){

                 // Insert new user into database
                 $insert = "INSERT INTO user_db (name, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user_type')";
                 mysqli_query($conn, $insert);

                 // Redirect to login page with success message
                 $success[] = 'Registration Successful!';
                 header('location:signin.php');
              }else{
                 // Display error message if password and confirm password do not match
                 $error[] = 'Password and Confirm Password do not match!';
              }

           }else{
              // Display error message if email already exists in database
              $error[] = 'Email already exists!';
           }

};
?>
<!DOCTYPE html>
<html lang="en">
          <head>
             <meta charset="UTF-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge">
             <meta name="viewport" content="width=device-width, initial-scale=1.0">
             <link rel="icon" href="images/svci.icon.png" type="image/x-icon">
             <title>Register Form</title>
             <!-- custom css file link  -->
             <link rel="stylesheet" href="css/style.css">
             </head>
      <body>
            <div class="form-container" style="background: linear-gradient(to bottom, #87CEFA, #1E90FF);">
              <form action="" method="post">
                <a href="index.php">
                  <img src="images/svci.png.png" alt="" class="logo"  style="width: 70px; height: 70px;"></a>
                    <h3>SVCI Computer Laboratory An Internet of Things System | Sign up</h3>
                      <?php
                // Display error messages, if any
                if(isset($error)){
                   foreach($error as $error){
                      echo '<span class="error-msg">'.$error.'</span>';
                   };
                };
                ?>
                <!-- User registration inputs -->
                <input type="text" name="name" required placeholder="Enter your Name">
                <input type="email" name="email" required placeholder="Enter your Email">
                <input type="password" name="password" required placeholder="Enter your Password">
                <input type="password" name="cpassword" required placeholder="Confirm your Password">
                <select name="user_type">
                   <option value="user">User</option>
                   <!-- <option value="admin">Admin</option> -->
                </select>
                <!-- Submit button -->
                <input type="submit" name="submit" value="register now" class="form-btn">
                <!-- Sign in link -->
                <p>Already have an account? <a href="signin.php">Sign In now</a></p>
              </form>

            </div>

        </body>
</html>
