<?php
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', 'Abcd11121314!');
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_NAME', 'GamesDB');

function GetConnection()
{
    $dbConn = @mysqli_connect(DB_SERVER, DB_USER, DB_PSWD, DB_NAME, 3306)
        or die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error());

    return $dbConn;
}

function GetChildPages($dbConn, $Parent = 0)
{
    $query = "SELECT id, title, header, content FROM SubPage WHERE isActive = 1 AND parentPage = " . $Parent . " ORDER BY ParentPage ASC;";

    return @mysqli_query($dbConn, $query);
}

function GetAllPages($dbConn)
{
    $query = "SELECT id, title, header, content, parentPage, isActive FROM SubPage ORDER BY parentPage ASC;";

    return @mysqli_query($dbConn, $query);
}

function GetPageContent($dbConn, $Id)
{
    $return = null;

    $query = "SELECT id, title, header, content, parentPage FROM SubPage WHERE isActive = 1 AND id = " . $Id;
    $return = @mysqli_query($dbConn, $query);

    if ((!$return) || ($return->num_rows < 1)) {
        $query = "SELECT id, title, header, content, parentPage FROM SubPage WHERE isActive = 1 limit 1;";

        $return = @mysqli_query($dbConn, $query);
    }

    return $return;
}

function UpdatePageContent($dbConn, $id, $title, $header, $content)
{
	$query = "UPDATE SubPage SET title = '" . $title . "', header = '" . $header . "', content = '" . $content . "' WHERE id = " . $id . ";";

	return @mysqli_query($dbConn, $query);
}

function RemovePage($dbConn, $Id)
{
    $query = "UPDATE SubPage SET isActive = 0 WHERE id = " . $Id . ";";

    return @mysqli_query($dbConn, $query);
}

function UnremovePage($dbConn, $Id)
{
	$query = "UPDATE SubPage SET isActive = 1 WHERE id = " . $Id . ";";

	return @mysqli_query($dbConn, $query);
}
?>