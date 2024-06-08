<?php
session_start();

if (!isset($_GET["postID"])) {
    echo "<script type='text/javascript'>alert('post not specified');</script>";
    header("Location: homepage.php");
    die();
} else if (!isset($_SESSION["currentUser"])) {
    echo "<script type='text/javascript'>alert('Log in to post comment');</script>";
    header("Location: login.php");
    die();
}
?>

<html>

<head>
    <link rel="stylesheet" href="css/form.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bodyMain.css">
</head>

<body>
    <div class="bodyMain">
        <?php
        $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
        mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
        $postID = $_GET['postID'];
        $query = "SELECT * FROM threadpost WHERE id =$postID ;";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $postData = mysqli_fetch_assoc($result);
        $postOpenerID = $postData["authorID"];

        echo " <script>console.log('postID : , openerID = ')</script>";


        $query = "SELECT username FROM student WHERE student.id = '$postOpenerID'";
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
        $postOpener = mysqli_fetch_assoc($result)["username"];

        echo "<h3>Write what you want to say to $postOpener!</h3>"; ?>

        <form action="" method="post" id="commentForm">
            <div class="formBox">
                <label for="body"></label>
                <input type="textarea" name="body" required>
                <input type="submit" value="Post Comment!">
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
    $insertPostQuery = "INSERT INTO comment (postID, authorID, body) VALUES ('$postID', '$authorID', '$body')";

    $result = mysqli_query($db, $insertPostQuery) or die(mysqli_error($db));

    //find original project with groupID
    $findOriginalProjectQuery = "SELECT id FROM project WHERE id = (SELECT groupID FROM threadpost WHERE id = $postID)";
    $result = mysqli_query($db, $findOriginalProjectQuery) or die(mysqli_error($db));
    $projectID = mysqli_fetch_assoc($result)["id"];


    header("Location: projectThread.php?projectID=$projectID");
    die();
} ?>