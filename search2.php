<?php
// Database configuration
$dbHost     = "lollifedb.mysql.database.azure.com";
$dbUsername = "kimm240@lollifedb";
$dbPassword = "gusrb13579!";
$dbName     = "data";
$dbPort     = "3306";

// Create database connection
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName, $dbPort);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if (isset($_GET['term'])){
    $return_arr = array();

    $keyword = $_GET['term'];
    $sql = "SELECT DISTINCT university_fullname FROM university WHERE university_fullname LIKE '%".$keyword."%' LIMIT 10";
    $result = mysqli_query($db, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $return_arr[] =  $row['university_fullname'];
    }

    echo json_encode($return_arr);
}

?>
