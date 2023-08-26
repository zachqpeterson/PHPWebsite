<?php
$MyTitle = "Signup";

include_once "dbConnector.php";
include_once "MyHeader.php";

if(array_key_exists("Username", $_POST))
{
    $Data = CheckForUser($myDbConn, $_POST["Username"]);
    if($Data && mysqli_num_rows($Data) > 0)
    {
        echo "User " . $_POST["Username"] . " already exists";
    }
    else if(!array_key_exists("Password", $_POST) || !array_key_exists("ConfirmPassword", $_POST) || $_POST["Password"] != $_POST["ConfirmPassword"])
    {
        echo "Passwords Do not Match or Are Invalid";
    }
    else
    {
        CreateUser($myDbConn, $_POST["Username"], $_POST["Password"]);
    }
}

?>

<form method="post">
    <input type="text" name="Username" placeholder="Username" /><br />
    <input type="password" name="Password" placeholder="Password" /><br />
    <input type="password" name="ConfirmPassword" placeholder="Confirm Password" /><br />
    <button type="submit">Submit</button>
</form>

<br><a href="Login.php">Login Instead</a>