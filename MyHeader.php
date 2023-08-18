<?php
session_start();

include_once "dbConnector.php";
include_once "Helper.php";
?>

<?php

if(array_key_exists('Login', $_POST))
{
    if(isset($_SESSION['isAdmin']))
    {
        unset($_SESSION['isAdmin']);
        unset($_SESSION['Username']);
        header(0);
    }
    else
        header("Location:Login.php");
}

$Style = 1;

if(isset($PrefStyle))
{
	$Style = $PrefStyle;
}
else
{
	if (isset($_COOKIE["SelectedStyle"]) == true) {
		$Style = $_COOKIE["SelectedStyle"];
	} else {
		$_COOKIE["SelectedStyle"] = $Style;
	}
}

if (!isset($MyTitle))
    $MyTitle = "Library";
$MyHeader = "Games Library";

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
	<title><?php echo $MyTitle ?></title>
	<link rel="stylesheet" type="text/css" href="/format.css">
    <?php
    switch ($Style) {
        case 1:
            echo '<link rel="stylesheet" type="text/css" href="/darkTheme.css">';
            break;
        case 2:
            echo '<link rel="stylesheet" type="text/css" href="/lightTheme.css">';
            break;
        case 3:
            echo '<link rel="stylesheet" type="text/css" href="/neumontTheme.css">';
            break;
        default:
            echo '<link rel="stylesheet" type="text/css" href="/darkTheme.css">';
            break;
    }
    ?>

</head>
<body>

<h1>
	<?php 
	echo $MyHeader;
	if($_SESSION["isAdmin"]) { echo " - ADMIN"; }
	?>
</h1>

<?php
$myDbConn = GetConnection();
?>

<a class="menu" href="Index.php">Home</a>
<a class="menu" href="Preferences.php">Settings</a>
<a class="menu" href="About.php">About</a>

<form class="login" method="post">
	<button class="login" type="submit" name="Login"><?php echo (isset($_SESSION["Username"]) ? "logout" : "login") ?></button>
</form>

<br />