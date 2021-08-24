<?php

require('config.inc.php');
require('utility.php');

session_start();
$id = session_id();
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: nonononono! " . $conn->connect_error);
}
postProcessing($id, $conn);
?>

<html>
<body>
<h1>Thank You!!!</h1>

<p>To receive credit please take a screen shot or a photo of this page and email it to apl@ualberta.ca</p>
<p>Here is your survey ID for verification purposes:</p>

<h2><?php echo $id ?></h2>
</body>
</html>

