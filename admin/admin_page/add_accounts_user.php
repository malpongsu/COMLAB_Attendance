<?php
include "../functions/config.php";

session_start();
if(!isset($_SESSION['admin_name'])){
    header('Location:../admin_signin.php');
    exit;
}

ini_set("display_errors",0);

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = $_POST['password'];
   $user_type = "user";

   // Check if the email already exists in the database
   $select = "SELECT email FROM user_db WHERE email = '$email'";
   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) == 0){

      // Insert the new user into the database
      $sql = "INSERT INTO user_db (name, email, password, user_type) VALUES ('$name', '$email', '$pass', '$user_type')";
      $result = mysqli_query($conn, $sql);

      if ($result){
        // Redirect to the admin accounts page with a success message
        header("Location:admin_accounts.php ?msg=New account created successfully");
      } else {
         echo "Failed: " . mysqli_error($conn);
      }

   } else {
      // Display an alert if the email already exists in the database
      echo "<script>alert('Username already exists!');</script>";
   }

}
?>

<?php
if(isset($_POST['cancel'])) {
  // Redirect to the admin accounts page if the cancel button is clicked
  header("Location: admin_accounts.php");
  exit();
}
?>


<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> SVCI | Administrator</title>
    <link rel="stylesheet" href="../css/add_accounts.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="icon" href="../images/svci.icon.png" type="image/x-icon">
    <script src="../js/scriptchart.js"></script>
    </head>

<body>
  <div class="sidebar">
    <div class="logo-details">
      <a href="admin_dashboard.php"><img src="../images/svci.png.png" alt="SVCI LOGO">
      </a>
      <span class="logo_name">Administrator</span>
    </div>
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
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Accounts</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <i class='bx bx-user'></i>
        <!-- <span> <?php echo $_SESSION['admin_name'] ?></span> -->
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

<div class="home-content">
  <div class="title"> STUDENT'S - New Account</div>
  <div class="attendance box">
    <form method="post">
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your Name">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control"  name="email" placeholder="Enter your Username">
      </div>
      <div class="form-group">
        <label for="email">Password</label>
        <input type="text" class="form-control" name="password" placeholder="Enter your Password">
      </div>
      <div class="form-group">
        <select name="user_type">
           <option value="user">User</option>

        </select>
      </div>
        <button type="submit" name="submit" class="btn btn-primary">Create</button>
        <button type="cancel" name="cancel" class="btn btn-secondary" onclick = href='admin_accounts.php?id=5'">Cancel</button>
    </form>
  </div>
</div>
</body>
<html>
