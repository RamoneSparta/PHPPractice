<?php

require 'config.inc.php';

if (isset($_GET['id']) && ctype_digit($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    header('Location: select.php');
}

$db = new mysqli
(
    MYSQL_HOST,
    MYSQL_USER,
    MYSQL_PASSWORD,
    MYSQL_DATABASE
);

$sql = "DELETE FROM users WHERE id=$id";
$db->query($sql);
echo '<p>User Deleted!</p>';
$db->close();


?>