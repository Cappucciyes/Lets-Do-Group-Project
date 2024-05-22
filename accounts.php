<?php
$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

if ($_GET["accountAction"] = "createAccount") {
    $newUsername = $_POST["username"];
    $newPassword = $_POST["password"];
    echo "successfully got username:$newUsername, password:$newPassword";
    $query = "INSERT INTO student (username, password) values ('$newUsername', '$newPassword')";
    mysqli_query($db, $query) or die(mysqli_error($db));
} else if ($_GET["accountAction"] = "login") {
}
