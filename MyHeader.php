<?php
session_start();

include_once "dbConnector.php";
include_once "Helper.php";
?>
<!--<script src="https://cdn.jsdelivr.net/npm/js-cookie/dist/js.cookie.min.js"></script>
  <script>
    // code to set the `color_scheme` cookie
    var $color_scheme = Cookies.get("color_scheme");
    function get_color_scheme() {
      return (window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)").matches) ? "dark" : "light";
    }
    function update_color_scheme() {
      Cookies.set("color_scheme", get_color_scheme());
    }
    // read & compare cookie `color-scheme`
    if ((typeof $color_scheme === "undefined") || (get_color_scheme() != $color_scheme))
      update_color_scheme();
    // detect changes and change the cookie
    if (window.matchMedia)
      window.matchMedia("(prefers-color-scheme: dark)").addListener( update_color_scheme );
  </script>-->
<?php
//$color_scheme = isset($_COOKIE["color_scheme"]) ? $_COOKIE["color_scheme"] : false;
//if ($color_scheme === false) $color_scheme = 'light';
//if ($color_scheme == 'dark') {
//    setcookie("SelectedStyle", 1, time() + 3600);
//    $PrefStyle = 1;
//} else {
//    setcookie("SelectedStyle", 2, time() + 3600);
//    $PrefStyle = 2;
//}
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