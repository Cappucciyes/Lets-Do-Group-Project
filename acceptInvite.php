<?php
$inviteID = $_POST["inviteID"];

$inviteQuery = "INSERT INTO projectmembers (groupID, memberID) 
    VALUES (
        (SELECT groupID FROM invite WHERE id = '$inviteID'), 
        (SELECT receivedID FROM invite WHERE id = '$inviteID')
    );";

$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

$inviteResult = mysqli_query($db, $inviteQuery);

if ($inviteResult) {
    $deleteQuery = "DELETE FROM invite where id = '$inviteID'";
    mysqli_query($db, $inviteQuery) or die(mysqli_error($db));

    header("Location: homepage.php");
    die();
} else {
    echo "faild to invite: inviteQuery failed";
}
