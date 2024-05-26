<?php
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

$toCheck = $_GET["checkFor"];
$result;

if ($toCheck == "project") {
    $query = "SELECT * FROM project WHERE opener =" . $_SESSION['currentUser'] . " AND ";

    if (mysqli_num_rows(mysqli_query($db, $query)) > 0)
        $result = ["duplicates" => true];
    else
        $result = ["duplicates" => false];
}


//https://stackoverflow.com/questions/4064444/returning-json-from-a-php-script
header('Content-type: application/json');
echo json_encode($data);
