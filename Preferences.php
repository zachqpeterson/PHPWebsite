<?php

include_once "dbConnector.php";
if (array_key_exists("styleButton", $_POST))
{
	$PrefStyle = $_POST['styleButton'];
    if (isset($_SESSION["Username"])) {
        ChangeTheme(GetConnection(), $_SESSION["Username"], $PrefStyle);
    }
}

include_once "MyHeader.php";

if (array_key_exists("styleButton", $_POST))
{
    setcookie("SelectedStyle", $_POST['styleButton'], time() + 3600);
    if (isset($_SESSION["Username"])) {
        ChangeTheme(GetConnection(), $_COOKIE["SelectedStyle"], $PrefStyle);
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
