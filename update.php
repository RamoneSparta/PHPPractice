<?php

require 'config.inc.php';
require 'auth.inc.php';

if (isset($_GET['id']) && ctype_digit($_GET['id']))
{
    $id = $_GET['id'];
}
else
{
    header('Location: select.php');
}

$name = "";
$gender = "";
$colour = "";
$tc = "";

if(isset($_POST['submit']))
{
    $ok = true;

    if(!isset($_POST['name']) || $_POST['name'] === '')
    {
        $ok = false;
    }
    else 
    {
        $name = $_POST['name'];
    };
    if(!isset($_POST['gender']) || $_POST['gender'] === '')
    {
        $ok = false;
    }
    else 
    {
        $gender = $_POST['gender'];
    };
    if(!isset($_POST['colour']) || $_POST['colour'] === '')
    {
        $ok = false;
    }
    else 
    {
        $colour = $_POST['colour'];
    };

    if(!isset($_POST['tc']) || $_POST['tc'] === '')
    {
        $ok = false;
    }
    else 
    {
        $tc = $_POST['tc'];
    };

    if($ok)
    {
        $db = new mysqli
        (
            MYSQL_HOST,
            MYSQL_USER,
            MYSQL_PASSWORD,
            MYSQL_DATABASE
        );
        $sql = sprintf
        (
            "UPDATE users SET name = '%s', gender = '%s', colour = '%s'
            WHERE id='%s'",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($colour),
            $id
        );
        $db->query($sql);
        echo '<p>User updated!</p>';
        $db->close();
    }
}
else
{
    $db = new mysqli
    (
        MYSQL_HOST,
        MYSQL_USER,
        MYSQL_PASSWORD,
        MYSQL_DATABASE
    );
    $sql = "SELECT * FROM users WHERE id=$id";
    $result = $db->query($sql);
    foreach ($result as $row)
    {
        $name = $row['name'];
        $gender = $row['gender'];
        $colour = $row['colour'];
        
    }
    $db->close();

    readfile('header.tmpl.html');
}

?>

<form action="" method="post">

User name: <input type="text" name="name" value="<?php 
echo htmlspecialchars($name, ENT_QUOTES);
?>"> <br>
Gender: 
<input type='radio' name = 'gender' value='f'
<?php
if($gender === 'f')
{
    echo 'checked';
}
?>> Female
<input type='radio' name = 'gender' value='m'<?php
if($gender === 'm')
{
    echo 'checked';
}
?>> Male
<input type='radio' name = 'gender' value='o'<?php
if($gender === 'o')
{
    echo 'checked';
}
?>> Other <br/>

Favourite colour:
<select name="colour">
<option value="">Please Select</option>
<option value="#f00"<?php
if($colour === '#f00')
{
    echo ' selected';
}
?>>Red</option>
<option value="#0f0"<?php
if($colour === '#0f0')
{
    echo ' selected';
}
?>>Green</option>
<option value="#00f"<?php
if($colour === '#00f')
{
    echo ' selected';
}
?>>Blue</option>
</select><br>
<br>

<input type="checkbox" name="tc" value="ok"
<?php
if($tc === 'ok')
{
    echo 'checked';
}
?>>
I accept the T&amp;C

<input type="submit" name="submit" value="Update">

</form>

<?php

readfile('footer.tmpl.html');

?>