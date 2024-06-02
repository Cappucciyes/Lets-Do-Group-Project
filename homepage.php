<!DOCTYPE html>

<head>
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="css/bodyMain.css">
</head>

<body>
    <div class="bodyMain">
        <div id="navBar" style="width: 100%; background-color: gray; text-align: center;">
            <a href="homepage.php">Homepage</a>
            <?php
            session_start();


            if (!isset($_SESSION["currentUser"])) {
                echo  "<a href='login.php'>Log in</a>
                    <a href='signup.php'>Sign up</a>";
            } else {
                $currentUserID = $_SESSION["currentUser"];
                echo " <a href='profile.php?student=$currentUserID'>Profile</a>
                    <a href='logout.php'>Log Out</a>";
            }
            ?>

        </div>

        <div id="homepageBody">
            <div id="bodyLeft">
                <?php
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
                <?php
                if (isset($_SESSION["currentUser"])) {
                    $query = "SELECT * FROM invite WHERE receivedID = $currenpUserID";

                    $invitesArr = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($inviteData = mysqli_fetch_assoc($invitesArr)) {
                        $inviteID = $inviteData['id'];
                        $groupID = $inviteData["groupID"];
                        $body = $inviteData["body"];
                        $senderID = $inviteData["authorID"];
                        $findSenderQuery = "SELECT username FROM student WHERE id = '$senderID'";
                        $senderUsername = mysqli_fetch_assoc(mysqli_query($db, $findSenderQuery))['username'];
                        $findGroupQuery = "SELECT name FROM project WHERE id = '$groupID'";
                        $groupName = mysqli_fetch_assoc(mysqli_query($db, $findGroupQuery))['name'];
                        echo "<div style='display: flex; flex-direction: column; border:1px solid black; padding: 0.5rem; margin:0.5rem;'>
                            <p>$senderUsername invites you to group project : '$groupName'</p>
                            <p>$body</p>
                            <form action='acceptInvite.php' method='post'>
                                <input type='text' name='inviteID' value = '$inviteID' hidden>
                                <button>Accept!</button>
                            </form>
                        </div>";
                    }
                }

                ?>


            </div>
            <div id="bodyRight">
                <?php
                echo "<a href='createProject.php'>Open New Project!</a><br><br>";
                ?>
                Project On going:<br>
                <?php
                if (isset($_SESSION["currentUser"])) {


                    $query = "SELECT * FROM project WHERE id IN (SELECT groupID FROM projectmembers WHERE memberID = '$currenpUserID') AND isClosed = 0";

                    $userProjectArr = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($project = mysqli_fetch_assoc($userProjectArr)) {
                        echo "<a href='projectThread.php?projectID=" . $project['id'] . "'>Project name: " . $project["name"] . "</a><br>";
                    }
                }
                ?>
                Project finished!:<br>
                <?php
                if (isset($_SESSION["currentUser"])) {


                    $query = "SELECT * FROM project WHERE id IN (SELECT groupID FROM projectmembers WHERE memberID = '$currenpUserID') AND isClosed = 1";

                    $userProjectArr = mysqli_query($db, $query) or die(mysqli_error($db));

                    while ($project = mysqli_fetch_assoc($userProjectArr)) {
                        echo "<a href='projectThread.php?projectID=" . $project['id'] . "'>Project name: " . $project["name"] . "</a><br>";
                    }
                }

                if (!isset($_SESSION["currentUser"])) {
                    echo "Welcome Guest!";
                }
                ?>
            </div>
        </div>
    </div>


</body>

</html>