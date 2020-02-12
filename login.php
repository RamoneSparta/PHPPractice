<?php

require 'config.inc.php';

$message = '';

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = new mysqli(
            MYSQL_HOST,
            MYSQL_USER,
            MYSQL_PASSWORD,
            MYSQL_DATABASE
        );

    $sql = sprintf(
        "SELECT hash FROM users WHERE name='%s'",
        $db->real_escape_string($_POST['name'])
    );

    $result = $db->query($sql);

    $row = $result->fetch_object();

    if ($row != null) {
        $hash = $row->hash;
        if (password_verify($_POST['password'], $hash)) {
            $message = 'Login successful!';
        } else {
            $message = 'Login failed.';
        }
    } else {
        $message = 'Login failed';
    }

    $db->close();
}


?>

<?php
readfile('header.tmpl.html');

echo "<div class='text-info'> $message</div>";
?>

<form method="post" action="">
    <div class="form-group">
        <div><label for='name'>Username</label></div>
        <input type="text" name="name" class="form-control" value="">
    </div>
    <br>
    <div class="form-group">
        <div><label for='password'>Password</label></div>
        <input type="password" class="form-control" name="password" value="">
    </div>

    <input type="submit" class="btn btn-primary" value="Login">


</form>



<?php
readfile('footer.tmpl.html');
?>