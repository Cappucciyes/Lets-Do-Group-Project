<?php
session_start();

if (!isset($_GET["projectID"])) {
    echo "<script type='text/javascript'>alert('Project not specified');</script>";
    header("Location: homepage.php");
    die();
} else if (!isset($_SESSION["currentUser"])) {
    echo "<script type='text/javascript'>alert('Log in to post');</script>";
    header("Location: login.php");
    die();
} else {
    $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
    $groupID = $_GET["projectID"];
    $currentUserID = $_SESSION["currentUser"];
    $isUserMemberQuery = "SELECT * FROM projectmembers WHERE groupID = $groupID AND memberID = $currentUserID";

    if (mysqli_num_rows(mysqli_query($db, $isUserMemberQuery)) < 1) {
        echo "<script type='text/javascript'>alert('Log in to post');</script>";
        header("Location: login.php");
        die();
    }
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
</head>

<body class="mainBody">
    <h1>Managing Projects</h1>
    <form action="?action=changeDate&projectID=<?php echo $groupID ?>" method='post'>
        <input type="date" name="newDate" required>
        <button>Update due date!</button>
    </form>
    <h2>Manage Members!</h2>
    <h2>Invite Someone!</h2>
    <form action="?action=sendInvite&projectID=<?php echo $groupID ?>" method='post'>
        <input type='text' name='invitingID' required>
        <button>Send Invite!</button>
    </form>
    <h2>Close Project?</h2>
    <form action="?action=close&projectID=<?php echo $groupID ?>" method='post'>
        <input type='text' name='projectID' value="<?php echo $groupID ?>" hidden>
        <button style='color: white; background-color: red;'>Close!</button>
    </form>
</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    if ($_GET['action'] == 'close') {
        $closingProjectID = $_POST["projectID"];
        $closeProjectuery = "UPDATE project SET isClosed = 1 WHERE id = '$closingProjectID'";
        mysqli_query($db, $closeProjectuery);

        header("Location: projectThread.php?projectID=$groupID");
        die();
    } else if ($_GET['action'] == 'changeDate') {
    }
} ?>