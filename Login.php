
<?php
session_start();
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



        if ($validAccount) {
            $userName = $_POST["Username"];
            $_SESSION["Username"] = $_POST["Username"];

            //  check if user is admin



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
    }
    else
        $userName = $_SESSION["Username"];
}

$MyTitle = "Login";
if (isset($userName))
    $MyTitle .= ' - ' . $userName;

include_once "MyHeader.php";

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

