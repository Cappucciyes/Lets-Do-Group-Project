<html>
<?php
session_start();

if (!isset($_GET["student"])) {
    echo "<script>
                    confirm('No user specified (query string for 'student' not set)');
                    </script>";

    header("Location: homepage.php");
    die();
}

?>

<head>
    <link rel="stylesheet" href="css/profile.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bodyMain.css">
</head>

<body>

    <div class="bodyMain">
        <?php include "navbar.php"; ?>
        <div id="bodyTop">
            <?php


            $profileStudentID = $_GET["student"];

            echo "Welcome!";
            // Profile
            $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
            mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));

            $getUserDataQuery = "SELECT * from student Where id = '$profileStudentID'";
            $userData = mysqli_fetch_assoc(mysqli_query($db, $getUserDataQuery));

            if ($userData["email"] == NULL) {
                $userData["email"] = "None";
            }

            echo "<h3>About User</h3>";
            echo "<div style='display: flex; flex-direction: row; justify-content: space-evenly; margin-bottom:1rem;'>
                        <div>Name: " . $userData["lastName"] . ", " . $userData["firstName"] . "</div>
                        <div>E-mail : " . $userData["email"] . "</div>
                    </div>";
            echo "<a href='editProfile.php'><button>Edit Profile!</button></a>";
            ?>

        </div>
        <div id="bodyBottom">

            <div id="ongoingDiv">
                Project On going:<br>
                <?php
                if (isset($_SESSION["currentUser"])) {


                    $query = "SELECT * FROM project WHERE id IN (SELECT groupID FROM projectmembers WHERE memberID = '$profileStudentID') AND isClosed = 0";

                    $userProjectArr = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($project = mysqli_fetch_assoc($userProjectArr)) {
                        echo "<a href='projectThread.php?projectID=" . $project['id'] . "'>Project name: " . $project["name"] . "</a><br>";
                    }
                }
                ?>
            </div>


            <div id="finishedDiv">
                Project finished!:<br>
                <?php
                if (isset($_SESSION["currentUser"])) {


                    $query = "SELECT * FROM project WHERE id IN (SELECT groupID FROM projectmembers WHERE memberID = '$profileStudentID') AND isClosed = 1";

                    $userProjectArr = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($project = mysqli_fetch_assoc($userProjectArr)) {
                        echo "<a href='projectThread.php?projectID=" . $project['id'] . "'>Project name: " . $project["name"] . "</a><br>";
                    }
                }
                ?>
            </div>


        </div>
    </div>

</body>

</html>