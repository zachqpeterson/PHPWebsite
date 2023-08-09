<?php
//include_once "MyHeader.php";

$Style = 1;


if (array_key_exists("styleButton", $_POST))
{
    setcookie("SelectedStyle", $_POST['styleButton'], time() + 3600);
}

if (isset($_COOKIE['SelectedStyle']))
{
    $Style = $_COOKIE['SelectedStyle'];
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
    echo 'style: ' . $_POST['styleButton'] . ' set';

//include_once "MyFooter.php";
?>
