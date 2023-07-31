<?php

// Create constants STOCK: MUST REPLACE
DEFINE('DB_USER', 'MyUser');
DEFINE('DB_PSWD', 'talasIV');
DEFINE('DB_SERVER', 'localhost');
DEFINE('DB_NAME', 'mytestdb');

// ///////////////////////////////////////////////////
// Get db connection
function ConnGet()
{
    // $dbConn will contain a resource link to the database
    // @ Don't display error
    $dbConn = @mysqli_connect(DB_SERVER, DB_USER, DB_PSWD, DB_NAME, 3308)
        or die('Failed to connect to MySQL ' . DB_SERVER . '::' . DB_NAME . ' : ' . mysqli_connect_error()); // Display messge and end PHP script

    return $dbConn;
}
// ///////////////////////////////////////////////////
// Get Select records based on the Parent Id
function MyPagesGet($dbConn, $Parent = 0)
{
    $query = "SELECT id, Title, Header1, Text1 FROM MyWebDocs where isActive = 1 and ParentPage = " . $Parent . " order by ParentPage asc, SortOrder Asc;";
    // SELECT id, Title, Header1, Text1 FROM MyWebDocs where isActive = 1 and ParentPage = " . $Parent . " order by ParentPage asc, SortOrder Asc;

    return @mysqli_query($dbConn, $query);
}
// ///////////////////////////////////////////////////
// Get all the page records
function MyPagesAllGet($dbConn)
{
    $query = "SELECT id, Title, Header1, Text1, ParentPage, SortOrder, isActive FROM MyWebDocs order by ParentPage asc, SortOrder Asc;";

    return @mysqli_query($dbConn, $query);
}
// ///////////////////////////////////////////////////
// Get Select page
function PageContentGet($dbConn, $Id)
{
    $return = null;

    $query = "SELECT id, Title, Header1, Text1 FROM MyWebDocs where isActive = 1 and id = " . $Id;
    $return = @mysqli_query($dbConn, $query);

    if ((!$return) || ($return->num_rows < 1)) {
        // return a defaul fault page
        $query = "SELECT id, Title, Header1, Text1 FROM MyWebDocs where isActive = 1 order by SortOrder asc limit 1;";

        $return = @mysqli_query($dbConn, $query);
    }

    return $return;
}

// ///////////////////////////////////////////////////
// Get all the page records
function MyPageremove($dbConn, $Id)
{

    // Never delete a page. set it to incative
    $query = "Update FROM MyWebDocs set isActive = 0 where id = " . $Id;

    return @mysqli_query($dbConn, $query);
}
?>


