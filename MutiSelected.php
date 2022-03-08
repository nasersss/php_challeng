<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Muitl selected</title>
</head>
<body>
    <div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <select name="Languages[]" id="Languages" multiple>
        <option  value="HTML">HTML</option>
        <option  value="CSS">CSS</option>
        <option  value="JAVASCRIPT">JAVASCRIPT</option>
        <option  value="Python">Python</option>
        <option  value="C#">C#</option>
        </select>
        <input type="submit"  name="submit">
    </form>
    </div>
    <?php

if (isset($_POST["submit"])){
        foreach($_POST["Languages"] as $subject){
            echo "You selected $subject" . "<br>";
        }
    }
    ?>
</body>
</html>
