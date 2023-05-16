<?php
// Require the common.php file that contains any common functions
require '../functions/config.php';

// Define the SQL query to retrieve all rows from the "student" table
$sql = "SELECT * FROM students";

// Execute the SQL query using the database connection in $conn and store the result in $res
$res = mysqli_query($conn, $sql);

// Create an empty string to build the HTML table in
$html = '<table><tr><td>#</td><td>Name</td><td>RFID UID</td></tr>';

// Loop through each row in the query result set and add a row to the HTML table
while ($row = mysqli_fetch_assoc($res)) {
    $html .= '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['rfid_uid'] . '</td></tr>';
}

// Close the table tag
$html .= '</table>';

// Set the response headers to indicate that this is an Excel file download and set the file name
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=students_rfid.xls');

// Output the HTML table, which will be interpreted as an Excel file by the browser due to the response headers
echo $html;
?>
