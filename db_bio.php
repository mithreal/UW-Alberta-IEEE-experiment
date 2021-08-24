<?php 

session_start();
require('config.inc.php');
require('utility.php');
$id = session_id();

$headphones = $_REQUEST["headphones"];
$age = $_REQUEST["age"];
$gender = $_REQUEST["gender"];
$hearingLoss = $_REQUEST["hearingLoss"];
$EngLang = $_REQUEST["EngLang"];

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: :-(" . $conn->connect_error);
}

function enterBioData($id, $headphones, $age, $gender, $hearingLoss, $EngLang, $conn) {
    $sql = "UPDATE biodata SET Session_ID='$id', Time_Started=NOW(), headphones='$headphones', Age='$age', Gender='$gender', Hearing_Loss='$hearingLoss', English_FL='$EngLang' where Session_ID='$id'";
    echo "enterBioData";
    runSQL($sql, $conn);
}

enterBioData($id, $headphones, $age, $gender, $hearingLoss, $EngLang, $conn);
mysqli_close($conn);
header("Location: soundTest.php");

?>

