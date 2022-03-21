<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Extract Zip File</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!--Uploud zip Files -->
    <form action="" method="post" enctype="multipart/form-data">
        Select Files to  upload:
        <br>
        <input type="file" name="zip_file" id="zip">
        <input type="submit" value="Upload zip" name="submit">
    </form>

    <br><br>
    <?php
    require 'dir_tree.php'; //include tree file 

    if (isset($_POST["submit"])) {

        $fileName = $_FILES['zip_file']['name'];
        $file_arr = explode(".", $fileName);

        if (strtolower($file_arr[count($file_arr) - 1]) == 'zip') {

            $finName = $file_arr[0];
            $zip = new zipArchive();

            if ($zip->open($_FILES['zip_file']["tmp_name"])) {

                $new_name = time().rand(1000000,1000000000000000);
                $zip->extractTo("./upload/$new_name");
                $zip->close();
                $files = opendir("./upload/$new_name/");
                $pathScan = "./upload/$new_name/";
                getDirectory($pathScan);
            }

        }

    }
    else{
        else echo "<h3> Please Selected Files </h3>"
    }
    ?>
</body>

</html>