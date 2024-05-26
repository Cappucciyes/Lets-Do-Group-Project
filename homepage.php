<html>

<head>
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    <div id="navBar" style="width: 100%; background-color: gray; text-align: center;"> This is nav bar working in progress</div>

    <div id="bodyMain">
        <div class="padding"></div>
        <div id="bodyLeft">
            <?php
            session_start();
            if (!isset($_SESSION["currentUser"]))
                echo "<div><a href='login.php'>Log In!</a></div><br><div><a href='signup.php'>Sign Up!</a></div>";
            else {
                echo "Welcome!";
                echo "<a href='createProject.php'>Open New Project!</a>";
            }
            ?>

        </div>
        <div id="bodyRight">
            Project On going
            <?php
            if (isset($_SESSION["currentUser"])) {
                $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
                mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
                $currenpUserID =  $_SESSION["currentUser"];

                $query = "SELECT * FROM project WHERE id IN (SELECT groupID FROM projectmembers WHERE memberID = '$currenpUserID') ";

                $userProjectArr = mysqli_query($db, $query) or die(mysqli_error($db));

                while ($project = mysqli_fetch_assoc($userProjectArr)) {
                    echo "<a href='projectThread.php?projectID=" . $project['id'] . "'>Project name: " . $project["name"] . "</a><br>";
                }
            } else {
                echo "Welcome Guest!";
            }
            ?>
        </div>
        <div class="padding"></div>
    </div>

</body>

</html>