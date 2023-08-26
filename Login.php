
<?php
$MyTitle = "Login";

include_once "dbConnector.php";
include_once "MyHeader.php";

$userName;
//  Checks if a user is already signed in
if (!isset($_SESSION["Username"])) {
    $validUser = true;
    $validPassword = true;

    //  Validates form input
    if (!array_key_exists("Username", $_POST) || empty($_POST["Username"]))
        $validUser = false;
    if (!array_key_exists("Password", $_POST) || empty($_POST["Password"]))
        $validPassword = false;

    $validAccount = false;
    if ($validUser && $validPassword) {
        $validAccount = true;

        //  Checks for user in Database
        $Data = Login($myDbConn, $_POST["Username"], $_POST["Password"]);
        if($Data && mysqli_num_rows($Data) > 0) $row = mysqli_fetch_array($Data);
        else $validAccount = false;

        //  Sets variables related to user if user exists
        if ($validAccount) {
            $userName = $_POST["Username"];
            $_SESSION["Username"] = $_POST["Username"];
            $_SESSION['isAdmin'] = $row['admin'];
            $PrefStyle = $row["theme"];
            header("Refresh:0");
        } else
            echo "<p>Incorrect Username or Password</p>";
    }
}
else
{
    //  Logs out user
    if(array_key_exists("logout", $_POST))
    {
        unset($userName);
        unset($_SESSION["Username"]);
        unset($_SESSION["isAdmin"]);
        header(0);
    }
    else
        $userName = $_SESSION["Username"];
}

$MyTitle = "Login";
if (isset($userName))
    $MyTitle .= ' - ' . $userName;

//  Sets logout form
if (isset($userName)) {
    echo '<p>' . $userName . '</p>';
    echo '<form method="post">
        <input type="hidden" name="logout" value="logout"/>
        <button type="submit">Logout</button>
    </form>';
}
else
{
    //  Resets form and displays what was wrong with login attempt
    if (!$validAccount) {
        echo '<form method="post">
	        <input type="text" name="Username" placeholder="Username"/><br/>
	        <input type="password" name="Password" placeholder="Password" /><br />
	        <button type="submit">Submit</button>
        </form>';

        if (array_key_exists("Username", $_POST) && !$validUser)
            echo '<p>* Bad Username</p>';

        if (array_key_exists("Password", $_POST) && !$validPassword)
            echo '<p>* Bad Password</p>';
    }
}

//  Adds link to signup page if not logged in
if(!isset($_SESSION["Username"]))
    echo '<br><a href="Signup.php">Signup Instead</a>';

include_once "MyFooter.php";
?>

