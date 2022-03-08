<?php

//$GLOBALS example
echo '<br> <br> <br> <h1 style="color:blue;" >$GLOBALS</h1>';
function test()
{
    $foo = "local variable";
    echo '$foo in global scope: ' . $GLOBALS["foo"] . "<br>";
    echo '$foo in current scope: ' . $foo . "<br>";
}

$foo = "Example content";
test();


//$_SERVER 
echo '<br> <br> <br> <h1 style="color:blue;">$_SERVER</h1>';

foreach ($_SERVER as $key => $value) {
    echo "<h3> <span style='color:red;'>$key</span> : $value </h3>";
}

// $_REQUEST 
echo '<br> <br> <br> <h1 style="color:blue;">$_REQUEST</h1>';
echo "<form action='index.php'>
<input type='text' name='name' id=''>
<input type='submit' value='send'>
</form>";
if(isset($_REQUEST['name'])){
    echo "<br> ".$_REQUEST['name'];
}
// $_GET 
echo '<br> <br> <br> <h1 style="color:blue;">$_GET</h1>';
echo "<form action='index.php' method='GET'>
<input type='text' name='name' id=''>
<input type='submit' value='send'>
</form>";
if(isset($_GET['name'])){
    echo "<br> ".$_GET['name'];
}


// $_POST 
echo '<br> <br> <br> <h1 style="color:blue;">$_POST</h1>';
echo "<form action='index.php' method='GET'>
<input type='text' name='name' id=''>
<input type='submit' value='send'>
</form>";
if(isset($_POST['name'])){
    echo "<br> ".$_POST['name'];
}

//session
session_start();
echo '<br> <br> <br> <h1 style="color:blue;">$_SESSION</h1>';
$_SESSION["newsession"]="Al-ghaith sission";
echo "<br> ".$_SESSION["newsession"];



// $_COOKIE
echo '<br> <br> <br> <h1 style="color:blue;">$_COOKIE</h1>';
setcookie("cookie[three]", "cookiethree");
setcookie("cookie[two]", "cookietwo");
setcookie("cookie[one]", "cookieone");
if (isset($_COOKIE['cookie'])) {
    foreach ($_COOKIE['cookie'] as $name => $value) {
        $name = htmlspecialchars($name);
        $value = htmlspecialchars($value);
        echo "$name : $value <br />\n";
    }
}


//Files
?>

<form action="" method="post" enctype="multipart/form-data">
<p>Pictures:
<input type="file" name="pictures[]" />
<input type="file" name="pictures[]" />
<input type="file" name="pictures[]" />
<input type="submit" value="Send" />
</p>
</form>

<?php
if(isset($_FILES["pictures"]["error"])){
    echo "This file is uploded";
    foreach ($_FILES["pictures"]["error"] as $key => $error) {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
            $name = basename($_FILES["pictures"]["name"][$key]);
            move_uploaded_file($tmp_name, "../data/$name");

            echo "<h3>$key: $name</h3>";
        }
    }
}

//_ENV[]
$alimh= $_ENV[''];
echo 'My username is ' .$alimh. '!';
