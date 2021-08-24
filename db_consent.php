<?php
session_start();
require('config.inc.php');
require('utility.php');
$id = session_id();
$checkNE = "";
$releaseConsent = "n";
$consent = $_REQUEST["consent"];
if (!empty($_REQUEST["rConsent"])) {
    $releaseConsent = $_REQUEST["rConsent"];
} 

echo $consent;
echo $releaseConsent;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: :-(" . $conn->connect_error);
}
echo "first";
function checkNotExist($id, $conn) {
    $sql = "SELECT Session_ID FROM biodata WHERE Session_ID = '$id'";
    $row = sqlRow($sql, $conn);
    $k = "";
    $t = (!empty($row[0]));
    echo "chkNO";
    //echo $t;
    if (!empty($row[0])) {
        $k = "NO";
    } else {
        $k = "YES";        
    }
    return $k;
}

function enterConsentData($id,  $consent, $releaseConsent, $conn) {
    $sql = "INSERT INTO biodata (Session_ID, Consent, releaseConsent) VALUES ('$id', '$consent', '$releaseConsent')";
    runSQL($sql, $conn);
}

$checkNE = checkNotExist($id, $conn);

if ($checkNE == "YES") {
    enterConsentData($id,  $consent, $releaseConsent, $conn);
    mysqli_close($conn);
    header("Location: bioForm.php");
} else if ($checkNE == "NO") {
    mysqli_close($conn);
    header("Location: bioForm.php");
} else {    
    echo "ERROR PROCESSING DATA: " . $checkNE;
    mysqli_close($conn);
}

?>

