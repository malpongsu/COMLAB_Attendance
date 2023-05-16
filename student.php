<?php
//Include common functions
require 'functions/common.php';

//Start session and check if user is logged in
session_start();
if(!isset($_SESSION['user_name'])){
    header('Location:signin.php');
    exit;
}

//Get all students from database
$students = $database->select("students", [
    'id',
    'name',
    'rfid_uid'
]);

?>
<?php
//Check if a year is passed in through a GET variable, otherwise use the current year
if (isset($_GET['year'])) {
    $current_year = int($_GET['year']);
} else {
    $current_year = date('Y');
}

//Check if a month is passed in through a GET variable, otherwise use the current month
if (isset($_GET['month'])) {
    $current_month = $_GET['month'];
} else {
    $current_month = date('n');
}

//Calculate the number of days in the selected month
$num_days = cal_days_in_month(CAL_GREGORIAN, $current_month, $current_year);

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
        <!-- Set character encoding -->
        <meta charset="UTF-8">
        <!-- Set page title -->
        <title> SVCI ComLab An Internet of Things System </title>
        <!-- Link to custom CSS file -->
        <link rel="stylesheet" href="css/style.student.css">
        <!-- Link to boxicons CSS file -->
        <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">
        <!-- Set viewport settings -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Set favicon -->
        <link rel="icon" href="images/svci.icon.png" type="image/x-icon">
        <!-- Link to Bootstrap JS file -->
        <script src="js/bootstrap.min.js"></script>
  </head>

<body>
  <!-- A sidebar container -->
  <div class="sidebar">
    <!-- A container for the logo and name of the website -->
    <div class="logo-details">
      <!-- An image of the SVCI logo that can be clicked to reload the page -->
      <img src="images/svci.png.png" onclick="location.reload();" alt="SVCI LOGO">
      <!-- The name of the website -->
      <span class="logo_name">SVCI | ComLab An IoT System</span>
    </div>

    <!-- A list of links to various pages on the website -->
    <ul class="nav-links">
      <!-- A link to the Dashboard page -->
      <li>
        <a href="index.php">
          <!-- An icon to represent the Dashboard page -->
          <i class='bx bx-grid-alt' ></i>
          <!-- The name of the link -->
          <span class="links_name">Dashboard</span>
        </a>
      </li>

      <!-- A link to the Students page -->
      <li>
        <a href="student.php">
          <!-- An icon to represent the Students page -->
          <i class='bx bx-box' ></i>
          <!-- The name of the link -->
          <span class="links_name">Students</span>
        </a>
      </li>

      <!-- A link to the Attendance page -->
      <li>
        <a href="attendance.php">
          <!-- An icon to represent the Attendance page -->
          <i class='bx bx-list-ul' ></i>
          <!-- The name of the link -->
          <span class="links_name">Attendance</span>
        </a>
      </li>

      <!-- A link to the logout function -->
      <li class="log_out">
        <a href="functions/logout.php">
          <!-- An icon to represent the logout function -->
          <i class='bx bx-log-out'></i>
          <!-- The name of the link -->
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
        <span class="dashboard">Student</span>
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
        <!-- An icon to represent the user's profile picture -->
        <i class='bx bx-user'></i>
        <!-- The user's name -->
        <span> <?php echo $_SESSION['user_name'] ?></span>
        <!-- An icon to represent a dropdown menu -->
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>
    <!-- Display the RFID information for all students in a table -->
    <div class="home-content">
      <div class="title">RADIO-FREQUENCY IDENTIFICATION INFORMATION</div>
      <div class="st-boxes">
        <div class="student box">
          <div class="container">
              <table class="table table-striped">
                  <thead class="thead-dark">
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">RFID UID</th>
                      </tr>
                  </thead>
                  <tbody>
                      <?php
                      //Loop through and list all the information of each user including their RFID UID
                      foreach($students as $user) {
                          echo '<tr>';
                          echo '<td scope="row">' . $user['id'] . '</td>';
                          echo '<td>' . $user['name'] . '</td>';
                          echo '<td>' . $user['rfid_uid'] . '</td>';
                          echo '</tr>';
                      }
                      ?>
                  </tbody>
              </table>
          </div>
      </div>
    </div>
  </div>
</section>
<!-- JavaScript files for the webpage -->
      <script src="js/script.dashboard.js"></script>
</body>
</html>
