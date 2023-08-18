<?php
DEFINE('DB_USER', 'root');
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_NAME', 'GamesDB');
require_once "DatabasePassword.php";

function GetConnection()
{
    $dbConn = @mysqli_connect(DB_SERVER, DB_USER, DB_PSWD, DB_NAME, 3306)
        or die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error());

    return $dbConn;
}

function GetChildPages($dbConn, $Parent = 0)
{
    $query = "SELECT id, image, title, header, content FROM SubPages WHERE isActive = 1 AND parentPage = " . $Parent . " ORDER BY title ASC;";

    return @mysqli_query($dbConn, $query);
}

function GetAllPages($dbConn)
{
    $query = "SELECT id, image, title, header, content, parentPage, isActive FROM SubPages ORDER BY parentPage ASC;";

    return @mysqli_query($dbConn, $query);
}

function GetPageContent($dbConn, $Id)
{
    $return = null;

    $query = "SELECT id, image, title, header, content, parentPage, isActive FROM SubPages WHERE id = " . $Id;
    $return = @mysqli_query($dbConn, $query);

    if ((!$return) || ($return->num_rows < 1)) {
        $query = "SELECT id, image, title, header, content, parentPage, isActive FROM SubPages WHERE isActive = 1 limit 1;";

        $return = @mysqli_query($dbConn, $query);
    }

    return $return;
}

function UpdatePageContent($dbConn, $id, $title, $header, $content)
{
	$query = "UPDATE SubPages SET title = '" . $title . "', header = '" . $header . "', content = '" . $content . "' WHERE id = " . $id . ";";

	return @mysqli_query($dbConn, $query);
}

function AddPage($dbConn, $parentPage, $title, $header, $content)
{
	$query = "INSERT INTO SubPages (parentPage, title, header, content, isActive) VALUES(" . $parentPage . ", '" . $title . "', '" . $header . "', '" . $content . "', true);";

	return @mysqli_query($dbConn, $query);
}

function RemovePage($dbConn, $Id)
{
    $query = "UPDATE SubPages SET isActive = 0 WHERE id = " . $Id . ";";

    return @mysqli_query($dbConn, $query);
}

function UnremovePage($dbConn, $Id)
{
	$query = "UPDATE SubPages SET isActive = 1 WHERE id = " . $Id . ";";

	return @mysqli_query($dbConn, $query);
}

function Login($dbConn, $username, $password)
{
	$query = "SELECT username, password, theme, admin FROM Users WHERE username = '" . $username . "' AND password = '" . $password . "';";

	return @mysqli_query($dbConn, $query);
}

function CheckForUser($dbConn, $username)
{
	$query = "SELECT username FROM Users WHERE username = '" . $username . "';";

	return @mysqli_query($dbConn, $query);
}

function CreateUser($dbConn, $username, $password)
{
	$query = "INSERT INTO Users (username, password, theme, admin) VALUES('" . $username . "', '" . $password . "', 1, true);";

	return @mysqli_query($dbConn, $query);
}

function ChangeTheme($dbConn, $username, $theme)
{
	$query = "UPDATE Users SET theme = " . $theme . " WHERE username = '" . $username . "';";

	return @mysqli_query($dbConn, $query);
}
?>