<?php
require 'config.inc.php';

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
            "INSERT INTO users (name, gender, colour) 
            VALUES ('%s', '%s', '%s')",
            $db->real_escape_string($name),
            $db->real_escape_string($gender),
            $db->real_escape_string($colour)
        );
        $db->query($sql);
        echo '<p>User added.</p>';
        $db->close();
    }
}

readfile('header.tmpl.html');


?>

<form action="" method="post">
<div class="form-group">
<div><label for='name'>Username</label></div> 
<input type="text" name="name" class="form-control" value="<?php 
echo htmlspecialchars($name, ENT_QUOTES);
?>">
</div> 
<br>
<div class="form-group">
<div><label for='password'>Password</label></div> 
<input type="password" class="form-control" name="password" value="">
</div> 
<br>
<div><label>Gender</label></div> 
<div class="form-check form-check-inline">
    <input type='radio' class="form-check-input" name = 'gender' value='f'
    <?php
        if($gender === 'f')
        {
            echo 'checked';
        }
    ?>> <label class="form-check-label">Female</label>
</div>
<div class="form-check form-check-inline">
<input type='radio' class="form-check-input" name = 'gender' value='m'<?php
if($gender === 'm')
{
    echo 'checked';
}
?>> <label class="form-check-label">Male</label>
</div>
<div class="form-check form-check-inline">
<input type='radio' class="form-check-input" name = 'gender' value='o'<?php
if($gender === 'o')
{
    echo 'checked';
}
?>> <label class="form-check-label">Other</label> </div> 
<br>
<br>

<div><label>Favourite Colour</label></div> 
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
?>>Blue</option>
<option value="#00f"<?php
if($colour === '#00f')
{
    echo ' selected';
}
?>>Green</option>
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

<br>
<br>
<input type="submit" name="submit" class="btn btn-primary" value="Register">

</form>

<?php

readfile('footer.tmpl.html')

?>