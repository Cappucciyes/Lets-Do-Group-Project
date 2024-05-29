<html>

<head>
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    <div id="navBar" style="width: 100%; background-color: gray; text-align: center;">
        <a href="homepage.php">Homepage</a>
        <a href="homepage.php">Homepage</a>
        <a href="homepage.php">Homepage</a>
    </div>

    <div id="bodyMain">
        <div class="padding"></div>
        <div id="bodyLeft">
            <?php
            session_start();

            // how do I call this fucntion via button?
            function logOut()
            {
                unset($_SESSION["currentUser"]);
                header("Location : homepage.php");
                die();
            }

            if (!isset($_SESSION["currentUser"]))
                echo "<div><a href='login.php'>Log In!</a></div><br><div><a href='signup.php'>Sign Up!</a></div>";
            else {
                echo "Welcome!";
                // Profile
                $db = mysqli_connect('localhost', 'root', '') or die('Unable to connect. Check your connection parameters.');
                mysqli_select_db($db, 'projectSite') or die(mysqli_error($db));
                $currenpUserID =  $_SESSION["currentUser"];

                $getUserDataQuery = "SELECT * from student Where id = '$currenpUserID'";
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
            }
            ?>

            <h3>Invites</h3>

        </div>
        <div id="bodyRight">
            <?php
            echo "<a href='createProject.php'>Open New Project!</a><br><br>";
            ?>
            Project On going:<br>
            <?php
            if (isset($_SESSION["currentUser"])) {


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