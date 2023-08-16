
<?php
include_once "dbConnector.php";
include_once "MyHeader.php";
$userName;

if (!isset($_SESSION["Username"])) {
    $validUser = true;
    $validPassword = true;

    if (!array_key_exists("Username", $_POST) || empty($_POST["Username"]))
        $validUser = false;
    if (!array_key_exists("Password", $_POST) || empty($_POST["Password"]))
        $validPassword = false;

    $validAccount = false;
    if ($validUser && $validPassword) {
        $validAccount = true;
        // check Database for user

        $Data = Login($myDbConn, $_POST["Username"], $_POST["Password"]);
        if($Data) $row = mysqli_fetch_array($Data);
        else $validAccount = false;

        if ($validAccount) {
            $userName = $_POST["Username"];
            $_SESSION["Username"] = $_POST["Username"];
            $_SESSION['isAdmin'] = $row['admin'];
            header("Refresh:0");
        } else
            echo "<p>Incorrect Username or Password</p>";
    }
}
else
{
    if(array_key_exists("logout", $_POST))
    {
        unset($userName);
        unset($_SESSION["Username"]);
        unset($_SESSION["isAdmin"]);
        header("Refresh:0");
    }
    else
        $userName = $_SESSION["Username"];
}

$MyTitle = "Login";
if (isset($userName))
    $MyTitle .= ' - ' . $userName;

if (isset($userName)) {
    echo '<p>' . $userName . '</p>';
    echo '<form method="post">
        <input type="hidden" name="logout" value="logout"/>
        <button type="submit">Logout</button>
    </form>';
}
else
{
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

include_once "MyFooter.php";
?>

