<?php
// Include configuration file
include "../functions/config.php";

// Start session
session_start();

// Check if admin is not logged in, redirect to admin signin page
if(!isset($_SESSION['admin_name'])){
    header('Location:../admin_signin.php');
    exit;
}

// Display errors
ini_set("display_errors",1);

// Check if form has been submitted
if(isset($_POST['submit'])){

   // Get input data and escape special characters
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
   $pass = $_POST['password'];
   $user_type = "admin";

   // Check if username already exists
   $select = "SELECT user_name FROM admin_db WHERE user_name = '$user_name'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) == 0){

      // Insert new admin account to the database
      $sql = "INSERT INTO admin_db (name, user_name, password, user_type) VALUES ('$name', '$user_name', '$pass', '$user_type')";
      $result = mysqli_query($conn, $sql);

      if ($result){
        // Redirect to admin accounts page with success message
        header("Location:admin_accounts.php ?msg=New account created successfully");
      } else {
         // Display error message if insertion fails
         echo "Failed: " . mysqli_error($conn);
      }

   } else {
      // Display error message if username already exists
      echo "<script>alert('Username already exists!');</script>";
   }

}

// Check if cancel button has been clicked
if(isset($_POST['cancel'])) {
  // Redirect to admin accounts page
  header("Location: admin_accounts.php");
  exit();
}
?>



<!DOCTYPE html>
<!-- Declare that this is an HTML5 document -->
<html lang="en" dir="ltr">
  <head>
    <!-- Declare the character set for the document -->
    <meta charset="UTF-8">

    <!-- Set the title of the document -->
    <title> SVCI | Administrator</title>

    <!-- Link to the CSS stylesheet for this page -->
    <link rel="stylesheet" href="../css/add_accounts.css">

    <!-- Link to the Boxicons CSS stylesheet from a CDN (Content Delivery Network) -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Set the viewport properties for mobile devices -->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <!-- Specify the favicon for the page (the icon that appears in the browser tab) -->
     <link rel="icon" href="../images/svci.icon.png" type="image/x-icon">

     <!-- Link to a JavaScript file that contains chart-related functions -->
    <script src="../js/scriptchart.js"></script>
    </head>

<body>
  <!-- A sidebar container -->
  <div class="sidebar">
    <!-- A container for the logo and name of the website -->
    <div class="logo-details">

      <a href="admin_dashboard.php"><img src="../images/svci.png.png" alt="SVCI LOGO"></a>
      <!-- The name of the website -->
      <span class="logo_name">Administrator</span>
    </div>
    <!-- A list of links to various pages on the website -->
      <ul class="nav-links">
        <li>
          <a>
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Admin Dashboard</span>
          </a>
        </li>
        <li>
          <a>
            <i class='bx bx-box' ></i>
            <span class="links_name">Students Information</span>
          </a>
        </li>
        <li>
          <a>
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Accounts</span>
          </a>
        </li>
        <li class="log_out">
          <a href="../functions/logout.php">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <!-- A button to toggle the visibility of the sidebar -->
      <div class="sidebar-button">
          <!-- An icon to represent the sidebar button -->
        <i class='bx bx-menu sidebarBtn'></i>
        <!-- The name of the dashboard -->
        <span class="dashboard">Accounts</span>
      </div>

      <!-- A search box to search for content on the website -->
      <div class="search-box">
        <!-- A text input for the user to type their search query -->
        <input type="text" placeholder="Search...">
        <!-- An icon to represent the search button -->
        <i class='bx bx-search' ></i>
      </div>

      <!-- A container for the user's profile information -->
      <div class="profile-details">
        <!-- An icon to represent the admin's profile picture -->
        <i class='bx bx-user'></i>
        <!-- The user's name -->
        <span> <?php echo $_SESSION['admin_name'] ?></span>
          <!-- An icon to represent a dropdown menu -->
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

<div class="home-content">
  <div class="title">ADMINISTRATOR - New Account</div>
  <div class="attendance box">
    <form method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your Name">
      </div>
      <div class="form-group">
        <label for="user_name">Username</label>
        <input type="user_name" class="form-control"  name="user_name" placeholder="Enter your Username">
      </div>
      <div class="form-group">
        <label for="user_name">Password</label>
        <input type="text" class="form-control" name="password" placeholder="Enter your Password">
      </div>
      <div class="form-group">
        <select name="user_type">
          <!-- Select user type, only admin is available -->
           <option value="admin">Admin</option>
        </select>
      </div>
      <!-- Submit and cancel buttons -->
        <button type="submit" name="submit" class="btn btn-primary">Create</button>
        <button type="cancel" name="cancel" class="btn btn-secondary" onclick = href='admin_accounts.php?id=5'>Cancel</button>
    </form>
  </div>
</div>
</body>
<html>
