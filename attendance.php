<?php
//Include common functions
require 'functions/common.php';

//Start session and check if user is logged in
session_start();
if(!isset($_SESSION['user_name'])){
    header('Location:signin.php');
    exit;
}

//Grab all the student from our database
$students = $database->select("students", [
    'id',
    'name',
    'rfid_uid'
]);

?>

<?php
//Check if we have a year passed in through a get variable, otherwise use the current year
if (isset($_GET['year'])) {
    $current_year = int($_GET['year']);
} else {
    $current_year = date('Y');
}

//Check if we have a month passed in through a get variable, otherwise use the current year
if (isset($_GET['month'])) {
    $current_month = $_GET['month'];
} else {
    $current_month = date('n');
}

//Calculate the amount of days in the selected month
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
    <link rel="stylesheet" href="css/style.attendance.css">
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
      <img src="images/svci.png.png" alt="SVCI LOGO">
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
        <span class="dashboard">Attendance</span>
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
        <div class="attendance box">
          <table class="table table-striped table-responsive">
              <thead class="thead-dark">
                  <tr>
                      <th scope="col">Name</th>
                      <?php
                          //Generate headers for all the available days in this month
                          for ( $iter = 1; $iter <= $num_days; $iter++) {
                            echo '<th scope="col" style="min-width:150px;max-width:250px;">' . $iter . '</th>';
                          }
                      ?>
                  </tr>
              </thead>
              <tbody>
                  <?php
                      //Loop through all our available student
                      foreach($student as $user) {
                          echo '<tr>';
                          echo '<td scope="row">' . $user['name'] . '</td>';

                          //Iterate through all available days for this month
                          for ( $iter = 1; $iter <= $num_days; $iter++) {

                              //For each pass grab any attendance that this particular user might of had for that day
                              $attendance = $database->select("attendance", [
                                  'clock_in'
                              ], [
                                  'user_id' => $user['id'],
                                  'clock_in[<>]' => [
                                      date('Y-m-d', mktime(0, 0, 0, $current_month, $iter, $current_year)),
                                      date('Y-m-d', mktime(24, 60, 60, $current_month, $iter, $current_year))
                                  ]
                              ]);

                              //Check if our database call actually found anything
                              if(!empty($attendance)) {
                                  //If we have found some data we loop through that adding it to the tables cell
                                  echo '<td class="table-success">';
                                  foreach($attendance as $attendance_data) {
                                      echo $attendance_data['clock_in'] . '</br>';
                                  }
                                  echo '</td>';
                              } else {
                                  //If there was nothing in the database notify the user of this.
                                  echo '<td class="table-secondary">No Data Available</td>';
                              }
                          }
                          echo '</tr>';
                      }
                  ?>
              </tbody>
          </table>
        </div>
  </div>
</section>
  <!-- JavaScript files for the webpage -->
  <script src="js/script.dashboard.js"></script>
</body>
</html>
