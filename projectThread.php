<?php
if (!isset($_GET["projectID"])) {
    echo "<script type='text/javascript'>alert('Project not specified');</script>";
    header("Location: homepage.php");
    die();
}
?>
<html>

<head></head>

<body>
    This is thread page for project
    <?php
    $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
    mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
    $projectID = $_GET['projectID'];
    $query = "SELECT * FROM project WHERE id =$projectID ;";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $projectName = mysqli_fetch_assoc($result)["name"];

    $query = "SELECT username FROM student, project WHERE student.id = project.opener";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    $projectOpener = mysqli_fetch_assoc($result)["username"];


    echo ": $projectName by : $projectOpener";

    ?>
</body>

</html>