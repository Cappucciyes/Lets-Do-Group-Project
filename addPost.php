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
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/bodyMain.css">
</head>

<body>
    <div class="bodyMain">
        <?php
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
        $projectID = $_GET['projectID'];
        $query = "SELECT * FROM project WHERE id =$projectID ;";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $projectData = mysqli_fetch_assoc($result);
        $projectName = $projectData["name"];
        $projectOpenerID = $projectData["opener"];

        echo " <script>console.log('projectID : , openerID = ')</script>";


        $query = "SELECT username FROM student, project WHERE student.id = '$projectOpenerID'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $projectOpener = mysqli_fetch_assoc($result)["username"];

        echo "<h3>Write what you want to say to other members in: $projectName by : $projectOpener!</h3>"; ?>

        <form action="" method="post" id="postForm">
            <div class="formBox">
                <label for="body"></label>
                <input type="textarea" name="body" required>
                <input type="submit" value="Post!">
            </div>
        </form>
    </div>

</body>

</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

    $authorID = $_SESSION["currentUser"];
    $body = $_POST["body"];
    $insertPostQuery = "INSERT INTO threadpost (groupID, authorID, body) VALUES ('$projectID', '$authorID', '$body')";

    $result = mysqli_query($db, $insertPostQuery) or die(mysqli_error($db));
    header("Location: projectThread.php?projectID=$projectID");
    die();
} ?>