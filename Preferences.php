<?php
include_once "MyHeader.php";

$Style = 1;

if (isset($_COOKIE['SelectedStyle'])) {
	$Style = $_COOKIE['SelectedStyle'];
}

if (array_key_exists("styleButton", $_POST))
{
    setcookie("SelectedStyle", $_POST['styleButton'], time() + 3600);
	$Style = $_POST['styleButton'];
}

echo 'Current Style: ' . $Style;

?>

Style: &nbsp; &nbsp;
<form method="post">
    <button name='styleButton' value='1'>Light Mode</button> &nbsp;
    <button name='styleButton' value='2'>Dark Mode</button> &nbsp;
    <button name='styleButton' value='3'>Other Mode</button>
</form>

<?php
include_once "MyFooter.php";
?>
