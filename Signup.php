<?php
$MyTitle = "Signup";

include_once "dbConnector.php";
include_once "MyHeader.php";

//  If form was submitted process input
if(array_key_exists("Username", $_POST))
{
    $Data = CheckForUser($myDbConn, $_POST["Username"]);
    //  Check if user with username already exists
    if($Data && mysqli_num_rows($Data) > 0)
    {
        echo "User " . $_POST["Username"] . " already exists";
    }
    //  Confirm both password fields mathc
    else if(!array_key_exists("Password", $_POST) || !array_key_exists("ConfirmPassword", $_POST) || $_POST["Password"] != $_POST["ConfirmPassword"])
    {
        echo "Passwords Do not Match or Are Invalid";
    }
    //  Valid input: Create new User
    else
    {
        CreateUser($myDbConn, $_POST["Username"], $_POST["Password"]);

        $userName = $_POST["Username"];
        $_SESSION["Username"] = $_POST["Username"];
        $_SESSION['isAdmin'] = false;
        header("Location:index.php");
    }
}

?>

<!-- Form to create new User -->
<form method="post">
    <input type="text" name="Username" placeholder="Username" /><br />
    <input type="password" name="Password" placeholder="Password" /><br />
    <input type="password" name="ConfirmPassword" placeholder="Confirm Password" /><br />
    <button type="submit">Submit</button>
</form>

<!-- Link to switch to login screen -->
<br><a href="Login.php">Login Instead</a>