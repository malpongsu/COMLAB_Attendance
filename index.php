<?php
// Import the common functions file
require 'functions/common.php';

// Attempt to import the configuration file if it exists
// The "@" symbol is used to suppress errors in case the file is missing or inaccessible
@include 'functions/config.php';

// Start a new session or resume an existing one
session_start();

// If the user is not logged in, redirect them to the sign-in page and exit the script
if(!isset($_SESSION['user_name'])){
    header('Location:signin.php');
    exit;
}
?>


<!DOCTYPE html>
<!-- Declare that this is an HTML5 document -->
<html lang="en" dir="ltr">

  <head>
    <!-- Declare the character set for the document -->
    <meta charset="UTF-8">

    <!-- Set the title of the document -->
    <title> SVCI ComLab An Internet of Things System </title>

    <!-- Link to the CSS stylesheet for this page -->
    <link rel="stylesheet" href="css/style.dashboard.css">

    <!-- Link to the Boxicons CSS stylesheet from a CDN (Content Delivery Network) -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css">

    <!-- Set the viewport properties for mobile devices -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Specify the favicon for the page (the icon that appears in the browser tab) -->
    <link rel="icon" href="images/svci.icon.png" type="image/x-icon">

    <!-- Link to a JavaScript file that contains chart-related functions -->
    <script src="js/scriptchart.js"></script>
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
          <span class="dashboard">Dashboard</span>
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
      <!-- This is a container for the content on the homepage with a blue gradient background -->
    <div class="home-content" style="background: linear-gradient(to bottom, #87CEFA, #1E90FF);">
        <!-- This is a container for four boxes, each displaying a different statistic -->
        <div class="overview-boxes">
            <!-- This box shows the number of CCS students -->
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">We Have</div>
                    <div class="number">1000</div>
                    <div class="box-topic">CCS Students</div>
                    <div class="indicator">
                    </div>
                </div>
                <!-- This is an icon of a group of people -->
                <i class='bx bxs-group cart'></i>
            </div>
            <!-- This box shows the number of CCS teachers -->
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">We Have</div>
                    <div class="number">50</div>
                    <div class="box-topic">CCS Teachers</div>
                    <div class="indicator">
                    </div>
                </div>
                <!-- This is an icon of a graduation hat -->
                <i class='bx bxs-graduation cart two'></i>
            </div>
            <!-- This box shows the number of computers -->
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">We Have</div>
                    <div class="number">10,000</div>
                    <div class="box-topic">Computers</div>
                    <div class="indicator">
                    </div>
                </div>
                <!-- This is an icon of a server -->
                <i class='bx bx-server cart three'></i>
            </div>
            <!-- This box shows the attendance rate of the school compared to the state average -->
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Attendance Rate</div>
                    <div class="number">99.1%</div>
                    <div class="box-topic">State Average</div>
                    <div class="indicator">
                    </div>
                </div>
                <!-- This is an icon of two arrows pointing in opposite directions -->
                <i class='bx bx-git-compare cart four'></i>
            </div>
        </div>
        <!-- This div contains two boxes for displaying information -->
      <div class="chart-boxes">
          <!-- This div displays a chart showing the Educational Stage -->
        <div class="recent box">
          <div class="title">Educational Stage</div>
          <div class="chart-details">
            <canvas id="myChart" style="width:100%;max-width:600px"></canvas>
          </div>
        </div>
        <!-- This div displays a list of available computer labs -->
        <div class="lab box">
          <div class="title">Computer Laboratory</div>
          <ul class="top-details">
            <!-- Each list item represents a computer lab -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 1 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            <!-- Similar to the above list item -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 2 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            <!-- Similar to the above list item -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 3 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            <!-- Similar to the above list item -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 4 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            <!-- Similar to the above list item -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 5 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            <!-- Similar to the above list item -->
            <li>
              <a>
                <label class="switch">
                  <input type="checkbox">
                  <span class="slider"></span>
                </label>
                <span class="comlab"> Computer Lab 6 </span>
              </a>
              <span class="avail">Available</span>
            </li>
            </ul>
          <script src="js/scriptcheckbox.js"></script>
        </div>
      </div>
    </div>
    <!-- The closing tag for the main section of the webpage -->
  </section>
  <!-- The footer of the webpage -->
  <!-- JavaScript files for the webpage -->
  <script src="js/script.dashboard.js"></script>
  <script src="js/sidebar.js"></script>
  <script src="js/EducationalStage.js"> </script>
</body>
</html>
