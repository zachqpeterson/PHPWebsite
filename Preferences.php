<?php

include_once "dbConnector.php";

// if the button was pressed save style as session and update db
if (array_key_exists("styleButton", $_POST))
{
	$PrefStyle = $_POST['styleButton'];
    if (isset($_SESSION["Username"])) {
        ChangeTheme(GetConnection(), $_SESSION["Username"], $PrefStyle);
    }
}

include_once "MyHeader.php";

// if the button was pressed save style as cookie and update db
if (array_key_exists("styleButton", $_POST))
{
    setcookie("SelectedStyle", $_POST['styleButton'], time() + 3600);
    if (isset($_SESSION["Username"])) {
        ChangeTheme(GetConnection(), $_SESSION["Username"], $_COOKIE["SelectedStyle"]);
    }
}

?>

<br/>
<form method="post">
    <button name='styleButton' value='1'>Dark Mode</button> &nbsp;
    <button name='styleButton' value='2'>Light Mode</button> &nbsp;
    <button name='styleButton' value='3'>Neumont Mode</button>
</form>

<?php
include_once "MyFooter.php";
?>
