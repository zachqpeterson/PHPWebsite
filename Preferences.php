<?php

if (array_key_exists("styleButton", $_POST))
{
	$PrefStyle = $_POST['styleButton'];
}

include_once "MyHeader.php";

if (array_key_exists("styleButton", $_POST))
{
    setcookie("SelectedStyle", $_POST['styleButton'], time() + 3600);
}

?>

<form method="post">
    <button name='styleButton' value='1'>Dark Mode</button> &nbsp;
    <button name='styleButton' value='2'>Light Mode</button> &nbsp;
    <button name='styleButton' value='3'>Neumont Mode</button>
</form>

<?php
include_once "MyFooter.php";
?>
