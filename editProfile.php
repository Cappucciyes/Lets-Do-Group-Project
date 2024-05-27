<?php
session_start();

if (!isset($_SESSION["currentUser"])) {
    header("Location : login.php");
    die();
}

$db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

$currentUserID = $_SESSION["currentUser"];
$userData = mysqli_fetch_assoc(mysqli_query($db, "SELECT * FROM student WHERE id = '$currentUserID'"));

$oldFirstName = $userData['firstName'];
$oldLastName = $userData['lastName'];
$oldEmail = $userData['email'];
?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <h1>Update Profile</h1>
    <form action="" method="post" id="signupForm">
        <div class="formBox">
            <fieldset>
                <legend>Personal Info: </legend>
                <!-- https://stackoverflow.com/questions/20589723/populate-html-form-from-database: Populating form from database -->
                <label for="firstName">First Name</label>
                <input type="text" maxlength="255" name="firstName" value="<?php echo $oldFirstName ?>" required>
                <br>
                <label for="lastName">Last Name</label>
                <input type="text" maxlength="255" name="lastName" value="<?php echo $oldLastName ?>" id="lastName" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo $oldEmail ?>">
            </fieldset>

            <button type="submit" id="submitButton">Update Profile!</button>
        </div>
    </form>
</body>
<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {

    $inputFirstName = $_POST["firstName"];
    $inputLastName = $_POST["lastName"];
    $inputEmail = $_POST["email"];

    //https://www.w3schools.com/sql/sql_update.asp
    if (trim($inputFirstName) != '') {
        $updateQuery = "UPDATE student SET firstName= '$inputFirstName' where id = $currentUserID ";
        mysqli_query($db, $updateQuery) or die(mysqli_error($db));
    }
    if (trim($inputLastName) != '') {
        $updateQuery = "UPDATE student SET lastName= '$inputLastName'where id = $currentUserID ";
        mysqli_query($db, $updateQuery) or die(mysqli_error($db));
    }
    if (trim($inputEmail) != '') {
        echo "<script>console.log('changed email to : '$inputEmail'')</script>";
        $updateQuery = "UPDATE student SET email= '$inputEmail'where id = $currentUserID";
        mysqli_query($db, $updateQuery) or die(mysqli_error($db));
    }

    header("Location: homepage.php");
    die();
}
?>


</html>