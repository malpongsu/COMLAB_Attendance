<?php
// Require the common.php file that contains any common functions
require '../functions/config.php';

// Define the SQL query to retrieve all rows from the "student" table
$sql = "SELECT * FROM attendance";

// Execute the SQL query using the database connection in $conn and store the result in $res
$res = mysqli_query($conn, $sql);

// Create an empty string to build the HTML table in
$html = '<table><tr><td>Name</td></tr>';

// Get the number of days in the current month
// Define the current year
$current_year = date('Y');


// Loop through each row in the query result set and add a row to the HTML table
while ($row = mysqli_fetch_assoc($res)) {
    $html .= '<tr><td>' . $row['name'] . '</td>';

    //Iterate through all available days for this month
    for ( $iter = 1; $iter <= $num_days; $iter++) {

        //For each pass grab any attendance that this particular user might of had for that day
        $attendance = $database->select("attendance", [
            'clock_in'
        ], [
            'user_id' => $row['id'],
            'clock_in[<>]' => [
                date('Y-m-d', mktime(0, 0, 0, $current_month, $iter, $current_year)),
                date('Y-m-d', mktime(24, 60, 60, $current_month, $iter, $current_year))
            ]
        ]);

        //Check if our database call actually found anything
        if(!empty($attendance)) {
            //If we have found some data we loop through that adding it to the tables cell
            foreach($attendance as $attendance_data) {
                $html .= '<td>' . $attendance_data['clock_in'] . '</td>';
            }
        } else {
            //If there was nothing in the database notify the user of this.
            $html .= '<td>No Data Available</td>';
        }
    }
    $html .= '</tr>';
}

// Close the table tag
$html .= '</table>';

// Set the response headers to indicate that this is an Excel file download and set the file name
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename=attendance.xls');

// Output the HTML table, which will be interpreted as an Excel file by the browser due to the response headers
echo $html;
?>
