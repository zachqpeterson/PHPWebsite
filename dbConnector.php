<?php

// Create constants STOCK: MUST REPLACE
DEFINE('DB_USER', 'root');
DEFINE('DB_PSWD', 'Abcd11121314!');
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_NAME', 'GamesDB');

// ///////////////////////////////////////////////////
// Get db connection
function ConnGet()
{
    // $dbConn will contain a resource link to the database
    // @ Don't display error
    $dbConn = @mysqli_connect(DB_SERVER, DB_USER, DB_PSWD, DB_NAME, 3306)
        or die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error()); // Display messge and end PHP script

    return $dbConn;
}
// ///////////////////////////////////////////////////
// Get Select records based on the Parent Id
function MyPagesGet($dbConn, $Parent = 0)
{
    $query = "SELECT id, title, header, content FROM SubPage where isActive = 1 and parentPage = " . $Parent . " order by ParentPage asc;";

    return @mysqli_query($dbConn, $query);
}
// ///////////////////////////////////////////////////
// Get all the page records
function MyPagesAllGet($dbConn)
{
    $query = "SELECT id, title, header, content, parentPage, isActive FROM SubPage order by parentPage asc;";

    return @mysqli_query($dbConn, $query);
}
// ///////////////////////////////////////////////////
// Get Select page
function PageContentGet($dbConn, $Id)
{
    $return = null;

    $query = "SELECT id, title, header, content FROM SubPage where isActive = 1 and id = " . $Id;
    $return = @mysqli_query($dbConn, $query);

    if ((!$return) || ($return->num_rows < 1)) {
        // return a defaul fault page
        $query = "SELECT id, title, header, content FROM SubPage where isActive = 1 limit 1;";

        $return = @mysqli_query($dbConn, $query);
    }

    return $return;
}

// ///////////////////////////////////////////////////
// Get all the page records
function MyPageRemove($dbConn, $Id)
{

    // Never delete a page. set it to incative
    $query = "Update FROM SubPage set isActive = 0 where id = " . $Id;

    return @mysqli_query($dbConn, $query);
}
?>


