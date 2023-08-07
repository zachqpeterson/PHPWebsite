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
$PageData = GetPageContent($myDbConn, $PageId);
PageDisplay($PageData);
mysqli_free_result($PageData);

$SubPages = GetChildPages($myDbConn, $PageId);
if (($PageId != "0") && ($SubPages) && ($SubPages->num_rows > 0)) {
    MenuDisplay($SubPages);
    mysqli_free_result($SubPages);
}

?>

<?php
if($_SESSION["isAdmin"] == 1)
{
	echo '<br/><br/><a href="EditPage.php?PageId=' . $PageId . '">Edit Page</a>';
}
?>

<?php
if ($myDbConn) {
    mysqli_close($myDbConn);
}

include_once "MyFooter.php";
?>

