<?php
include_once "MyHeader.php";
?>

<?php
$PageId = "1";
if (array_key_exists("PageId", $_GET) == true) {
    $PageId = $_GET["PageId"];
}
?>

<?php
$PageData = PageContentGet($myDbConn, $PageId);
PageDisplay($PageData);
mysqli_free_result($PageData);

$SubPages = MyPagesGet($myDbConn, $PageId);
if (($PageId != "0") && ($SubPages) && ($SubPages->num_rows > 0)) {
    MenuDisplay($SubPages);
    mysqli_free_result($SubPages);
}

?>

<?php

?>

<?php
if ($myDbConn) {
    mysqli_close($myDbConn);
}

include_once "MyFooter.php";
?>

