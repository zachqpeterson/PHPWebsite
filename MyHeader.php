<?php
session_start();

include_once "dbConnector.php";
include_once "Helper.php";
?>

<?php

$myStyle = "1";

// Check for Priv setting
if (isset($_SESSION["isAdmin"]) == false) {
    $_SESSION["isAdmin"] = 0; // Set default
}
// Check for style setting
if (isset($_COOKIE["MyStyle"]) == true) {
    $myStyle = $_COOKIE["MyStyle"];
} else {
    // Set default style
    $_COOKIE["MyStyle"] = $myStyle;
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
$myDbConn = ConnGet();
?>

&nbsp; &nbsp;<a href="Index.php">Home</a>

<?php
if ($_SESSION["isAdmin"] == 1) {
    echo '  &nbsp; &nbsp;<a href="ManagePages.php">Manage Pages</a>';
} else {
    echo '  &nbsp; &nbsp;<a href="Login.php">Login</a>';
}
?>

&nbsp; &nbsp;<a href="Preferences.php">Settings</a>
<br />