<?php
session_start();

include_once "dbConnector.php";
include_once "Helper.php";
?>

<?php

$myStyle = "1";

if (array_key_exists('Login', $_POST)) {
	if($_SESSION["isAdmin"] == 1) { $_SESSION["isAdmin"] = 0; }
	else { $_SESSION["isAdmin"] = 1; }
}
else if (!isset($_SESSION["isAdmin"])) {
    $_SESSION["isAdmin"] = 0;
}

if (isset($_COOKIE["SelectedStyle"]) == true) {
    $myStyle = $_COOKIE["SelectedStyle"];
} else {
    $_COOKIE["SelectedStyle"] = $myStyle;
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
	//Could do: echo '<link rel="stylesheet" type="text/css"  href="/myStyle' . $myStyle . '.css">'
    switch ($myStyle) {
        case "1":
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle1.css">';
            break;
        case "2":
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle2.css">';
            break;
        case "3":
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle3.css">';
            break;
        default:
            echo '<link rel="stylesheet" type="text/css"  href="/myStyle1.css">';
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

<form method="post">
	<button type="submit" name="Login"><?php echo ($_SESSION["isAdmin"] == 0 ? "login" : "logout") ?></button>
</form>

<?php
if ($_SESSION["isAdmin"] == 1) {
	echo '&nbsp;&nbsp;&nbsp;&nbsp;ADMIN';
}
?>

<br />