<?php
session_start();

include_once "dbConnector.php";
include_once "Helper.php";
?>

<?php

if (array_key_exists('Login', $_POST)) {
	if($_SESSION["isAdmin"] == 1) { $_SESSION["isAdmin"] = 0; }
	else { $_SESSION["isAdmin"] = 1; }
}
else if (!isset($_SESSION["isAdmin"])) {
    $_SESSION["isAdmin"] = 0;
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

$MyTitle = "Library";
$MyHeader = "Games Library";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta content="text/html; charset=ISO-8859-1"  http-equiv="content-type">
  <title><?php echo $MyTitle ?></title>
    <?php
    switch ($Style) {
        case 1:
            echo '<link rel="stylesheet" type="text/css"  href="/darkTheme.css">';
            break;
        case 2:
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle2.css">';
            break;
        case 3:
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle3.css">';
            break;
        default:
            echo '<link rel="stylesheet" type="text/css"  href="/darkTheme.css">';
            break;
    }
    ?>

</head>
<body>

<h1><?php echo $MyHeader ?></h1>

<?php
$myDbConn = GetConnection();
?>

&nbsp;&nbsp;<a href="Index.php">Home</a>
&nbsp;&nbsp;<a href="Preferences.php">Settings</a>
&nbsp;&nbsp;<a href="About.php">About</a>

<form method="post">
	<button type="submit" name="Login"><?php echo ($_SESSION["isAdmin"] == 0 ? "login" : "logout") ?></button>
</form>

<?php
if ($_SESSION["isAdmin"] == 1) {
	echo '&nbsp;&nbsp;&nbsp;&nbsp;ADMIN';
}
?>

<br />