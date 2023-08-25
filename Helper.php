<?php
include_once "dbConnector.php";
?>

<?php
function MenuDisplay($dataset)
{
    if ($dataset) {
        while ($row = mysqli_fetch_array($dataset)) {
            echo '<a href="index.php?PageId=' . $row['id'] . '" >' . $row['title'] . '</a><br/>';
        }
    }
    else {
        echo "No menu items<br />";
    }
}

function PageDisplay($PageData)
{
    if ($PageData) {
        $row = mysqli_fetch_array($PageData);

        echo '&nbsp; &nbsp; <h2> ' . $row['header'] . ' </h2>';
        if(strlen($row['image']) > 0) { echo '&nbsp; &nbsp; <img src="' . $row['image'] . '">'; }
        echo '&nbsp; &nbsp; <p> ' . $row['content'] . '</p> <br />';

    }
    else {
        echo "No Page data to display <br />";
    }
}
?>