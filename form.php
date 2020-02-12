<?php
$name = "";
$password = "";
$gender = "";
$colour = "";
$languages = [];
$comments = "";
$tc = "";

if (isset($_POST['submit'])) {
    $ok = true;

    if (!isset($_POST['name']) || $_POST['name'] === '') {
        $ok = false;
    } else {
        $name = $_POST['name'];
    };
    if (!isset($_POST['password']) || $_POST['password'] === '') {
        $ok = false;
    } else {
        $password = $_POST['password'];
    };
    if (!isset($_POST['gender']) || $_POST['gender'] === '') {
        $ok = false;
    } else {
        $gender = $_POST['gender'];
    };
    if (!isset($_POST['colour']) || $_POST['colour'] === '') {
        $ok = false;
    } else {
        $colour = $_POST['colour'];
    };
    if (!isset($_POST['languages']) || !is_array($_POST['languages']) || count($_POST['languages']) === 0) {
        $ok = false;
    } else {
        $languages = $_POST['languages'];
    };
    if (!isset($_POST['comments']) || $_POST['comments'] === '') {
        $ok = false;
    } else {
        $comments = $_POST['comments'];
    };
    if (!isset($_POST['tc']) || $_POST['tc'] === '') {
        $ok = false;
    } else {
        $tc = $_POST['tc'];
    };

    if ($ok) {
        printf(
            'Username: %s
    <br> Password: %s
    <br> Gender: %s
    <br> Colour: %s
    <br> languages: %s
    <br> Comments: %s
    <br> Terms and Conditions: %s',


            htmlspecialchars($name, ENT_QUOTES),
            htmlspecialchars($password, ENT_QUOTES),
            htmlspecialchars($gender, ENT_QUOTES),
            htmlspecialchars($colour, ENT_QUOTES),
            htmlspecialchars(implode(' ', $languages), ENT_QUOTES),
            htmlspecialchars($comments, ENT_QUOTES),
            htmlspecialchars($tc, ENT_QUOTES)
        );
    }
}

?>

<form action="" method="post">

    User name: <input type="text" name="name" value="<?php
                                                        echo htmlspecialchars($name, ENT_QUOTES);
                                                        ?>"> <br>
    Password: <input type="password" name="password">
    Gender:
    <input type='radio' name='gender' value='f' <?php
                                                if ($gender === 'f') {
                                                    echo 'checked';
                                                }
                                                ?>> Female
    <input type='radio' name='gender' value='m' <?php
                                                if ($gender === 'm') {
                                                    echo 'checked';
                                                }
                                                ?>> Male
    <input type='radio' name='gender' value='o' <?php
                                                if ($gender === 'o') {
                                                    echo 'checked';
                                                }
                                                ?>> Other <br />

    Favourite colour:
    <select name="colour">
        <option value="">Please Select</option>
        <option value="#f00" <?php
                                if ($colour === '#f00') {
                                    echo ' selected';
                                }
                                ?>>Red</option>
        <option value="#0f0" <?php
                                if ($colour === '#0f0') {
                                    echo ' selected';
                                }
                                ?>>Blue</option>
        <option value="#00f" <?php
                                if ($colour === '#00f') {
                                    echo ' selected';
                                }
                                ?>>Green</option>
    </select><br>

    Languages spoken:
    <select name="languages[]" multiple size="3">
        <option value="en" <?php
                            if (in_array('en', $languages)) {
                                echo ' selected';
                            }
                            ?>>English</option>
        <option value="sp" <?php
                            if (in_array('sp', $languages)) {
                                echo ' selected';
                            }
                            ?>>Spanish</option>
        <option value="sw" <?php
                            if (in_array('sw', $languages)) {
                                echo ' selected';
                            }
                            ?>> Swahili</option>
    </select><br>

    Comments: <textarea name="comments">
<?php
echo htmlspecialchars($comments, ENT_QUOTES);
?>
</textarea><br>

    <input type="checkbox" name="tc" value="ok" <?php
                                                if ($tc === 'ok') {
                                                    echo 'checked';
                                                }
                                                ?>>
    I accept the T&amp;C

    <input type="submit" name="submit" value="Register">

</form>