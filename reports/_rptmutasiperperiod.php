<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
session_start();
ob_start();
$upone = dirname(__DIR__, 1); // Adjusting for directory structure

// HTML and form for selecting date range and type
?>
<html>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
        input[type=submit] {
            background-color: #0a9396;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            margin: 4px 2px;
            cursor: pointer;
        }
        .me_date {
            padding: 5px 5px;
            color: black;
            font-size: 16px;
        }
    </style>

    <div align="center" style="background-color:#D35400;font-weight: bold;font-size: 30px;color:#F9E79F">
        ITEM MUTATION PER DATE PERIOD
    </div>
    <div><br></div>
    <div><br></div>
    <div align="center" style="padding:15px;">SELECT DATE</div>

    <!-- Date Range Selection Form -->
    <form action="" method="post">
        <div align="center">
            From: &nbsp;&nbsp;<input type="date" class="me_date" name="mydate" id="mydate">&nbsp;&nbsp;
            To: &nbsp;&nbsp;<input type="date" class="me_date" name="mydate2" id="mydate2">
        </div>
        <!-- <div align="center" style="padding:20px;">
            <select id="slcttype" name="slcttype" style="font-size:14px;width:200px;">
                <option value="0" selected>Select Type</option>
                <option value="All">All Account</option>
                <option value="Cash">Cash</option>
                <option value="A/R">A/R</option>
            </select>
        </div> -->
        <div align="center">
            <input type="submit" name="datesubmit" value="Process">
        </div>
    </form>

<?php
// If form is submitted, process the date range and generate report
if (isset($_POST['datesubmit'])) {
    $mydate = $_POST['mydate'];
    $mydate1 = date('Y-m-d', strtotime($mydate));
    $mydate2 = date('Y-m-d', strtotime($_POST['mydate2']));
    $_SESSION['reports'] = '1';
    // $mytype = $_POST['slcttype'];

    // Include the database connection file (adjust the path as needed)
    include $upone . "/class/_parkerconnection.php";

    // SQL query to fetch mutation data between the selected dates
    $sql = "
        SELECT 
            wmut.con_no,
            wmut.con_date,
            wmut.con_time,
            wmut.con_from,
            winv_from.i_name AS from_item,
            winv_from.ware_id as ware_from,
            wmut.con_qtyfrom,
            wmut.con_to,
            winv_to.i_name AS to_item,
            winv_to.ware_id as ware_to,
            wmut.con_qtyto
        FROM 
            wmutation wmut
        LEFT JOIN 
            winventory winv_from ON wmut.con_from = winv_from.i_code
        LEFT JOIN 
            winventory winv_to ON wmut.con_to = winv_to.i_code
        WHERE 
            wmut.con_date BETWEEN '$mydate1' AND '$mydate2';
    ";
    $DB_Server = "103.247.8.177";   
    $DB_Username = "mimj5729_myroot";   
    $DB_Password = "myroot@@##";               
    $DB_DBName = "mimj5729_matahari";          
    $DB_TBLName = "wmutation";  
              
            //create MySQL connection   
            
    $conn = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die();
    $Db = mysqli_select_db($conn, $DB_DBName) or die();
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Display the results
    if ($result) {
        $no_counter=0;
        echo "<table>";
        echo "<tr><th>No</th><th>Con No</th><th>Date</th><th>Time</th><th>From Item</th><th>Qty From</th><th>To Item</th><th>Qty To</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td align='center'>" . ++$no_counter . "</td>";
            echo "<td>" . $row['con_no'] . "</td>";
            echo "<td align='center'>" . $row['con_date'] . "</td>";
            echo "<td align='center'>" . $row['con_time'] . "</td>";
            echo "<td>" . $row['from_item'] . ' ( '.$row['ware_from']." )</td>";
            echo "<td align='center'>" . $row['con_qtyfrom'] . "</td>";
            echo "<td>" . $row['to_item'] . ' ( '.$row['ware_to']." )</td>";
            echo "<td align='center'>" . $row['con_qtyto'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No records found.";
    }
}
?>
</html>
