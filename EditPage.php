<?php
include_once "MyHeader.php";
?>

<?php
$PageId;
if (array_key_exists("PageId", $_GET) == true) {
	$PageId = $_GET["PageId"];
}

$PageData = mysqli_fetch_array(GetPageContent($myDbConn, $PageId));
$Deleted = !$PageData['isActive'];

if(array_key_exists('Delete', $_POST))
{
	if($Deleted == 0)
	{
		RemovePage($myDbConn, $PageId);
		$Deleted = 1;
	}
	else
	{
		UnremovePage($myDbConn, $PageId);
		$Deleted = 0;
	}
}

if (array_key_exists('Save', $_POST)) {
	UpdatePageContent($myDbConn, $PageId, $_POST['Title'], $_POST['Header'], $_POST['Content']);

	if(isset($_FILES['img']) && !empty($_FILES['img']['name']))
	{
		$name = $_FILES['img']['name'];
		$tempName = $_FILES['img']['tmp_name'];
		$path = "Images/" . $name;

		move_uploaded_file($tempName, $path);
		UpdatePageImage($myDbConn, $PageId, $path);
	}

	$PageData = mysqli_fetch_array(GetPageContent($myDbConn, $PageId));
}

if(array_key_exists('Add', $_POST)) {
	AddPage($myDbConn, $PageId, $_POST['Title'], $_POST['Header'], $_POST['Content']);
}

?>

<form method="post" enctype="multipart/form-data">
	<p>Title:<p/> <input type="text" name="Title" value="<?php echo $PageData['title'];?>" /><br/>
	<p>Header:<p/> <input type="text" name="Header" value="<?php echo $PageData['header'];?>" /><br />
	<p>Content:<p/> <textarea name="Content" rows="5" cols="40"><?php echo $PageData['content'];?></textarea><br />
	<p>Image:<p/> <input type="file" name="img" accept=".png,.jpg,.jpeg"/>
	<?php
		if($PageData['image'] != null)
		{
			echo "<p>Current Image: " . $PageData['image'] . "<p/>";
		}
		else
		{
			echo "<p>No Image!<p/>";
		}
	?>


	<button type="submit" name="Save">Save</button>
	<?php
		if($PageData['parentPage'] != null)
		{
			echo "<button type='submit' name='Delete'>" . ($Deleted ? "Restore Page" : "Delete page") . "</button>";
		}
	?>
</form>

<br/>
<br/>

<p>Create New Page:</p>
<form method="post">
	<p>Title:<p/> <input type="text" name="Title"/><br />
	<p>Header:<p/> <input type="text" name="Header"/><br />
	<p>Content:<p/> <textarea name="Content" rows="5" cols="40"></textarea>

	<button type="submit" name="Add">Add Page</button>
</form>

<?php
echo '<br/><br/><a href="index.php?PageId=' . ($Deleted ? $PageData['parentPage'] : $PageId) . '">Finish Edit</a>';
?>

<?php
if ($myDbConn) {
	mysqli_close($myDbConn);
}

include_once "MyFooter.php";
?>