<?php
session_start();
require('config.inc.php');
include('utility.php');

// data = [id, response, responseFile];
$data = $_REQUEST['data'];
$id = $data[0];
$response = $data[1];
$table = "TT_$id";
$listName = "";
$fname = "";
$responseFile = $data[2];


// initialize mysql connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// check if $table exists
$tExists = checkExists($table, $conn);

// create $table if $tExists is false
if ($tExists == false) {
    createTable($table, $conn);
}

// obtain $listName
$listName = findListName($table, $id, $conn);

// record data if it exists
if ($response != $id) {
    recordData($table, $listName, $id, $response, $responseFile, $conn);
    updateListDate($listName, $responseFile, $conn);
} // error checking? 

// get sentence
$fname = findNextSen($listName, $conn);

//send data
$data_out = "$listName, $fname";
echo $data_out;

mysqli_close($conn);

?>