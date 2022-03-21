<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/bootstrap-5.1.3-dist/css/bootstrap.css.map">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>New catogory</title>
    <style>

    </style>
</head>

<body>



    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'e-store');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_GET['submit'])) {

        $sql = "select * from category where id=$_GET[cat_id]";
        $rows = $conn->query($sql);
        if ($row = mysqli_fetch_assoc($rows)) {
            echo "<div class='row mt-5'>
                    <form action='update.catogory.php' method='post' class='col-8 m-auto h-50'>
                        <h1 class='t-alin mb-3'>Add New Catogory</h1>
                        <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                        <input type='text' placeholder='Catogory Name' value='$row[name]'  name='cat_name' id='' class='form-control'>
                        <input type='submit' name=submit class='btn btn-primary my-3 float-end' value='Update'>
                    </form>
                </div>";
        } else
            echo "<p id='alart' class='err-alart'>This Category is Note Found <span class='close'>X</span></p>";
    }
    if (isset($_POST['submit'])) {
        $cat_name = strtolower($_POST['cat_name']);
        $url = "./add.catogory.php?true=true";
        $sql = "UPDATE category SET name='$cat_name' WHERE id=" . $_POST['cat_id'];
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<p id='alart' class='sess-alart'> New category added successfully <span class='close'>X</span></p>";
            header('Location: ' . $url);
        } else {
            $sql = "select * from category where id=$_POST[cat_id]";
            $rows = $conn->query($sql);
            if ($row = mysqli_fetch_assoc($rows)) {
                echo "<div class='row mt-5'>
                    <form action='update.catogory.php' method='post' class='col-8 m-auto h-50'>
                        <h1 class='t-alin mb-3'>Add New Catogory</h1>
                        <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                        <input type='text' placeholder='Catogory Name' value=''  name='cat_name' id='' class='form-control'>
                        <input type='submit' name=submit class='btn btn-primary my-3 float-end' value='Update'>
                    </form>
                </div>";
            } else
                echo "<p id='alart' class='err-alart'>This Category is Note Found <span class='close'>X</span></p>";
                echo "<p id='alart' class='err-alart'>This Category is Diplicated <span class='close'>X</span></p>";
        }
    }
    ?>
    <script>
        const alart = document.getElementById('alart');



        alart.addEventListener('click', () => {
            alart.style.display = "none";
        });
    </script>

</body>

</html>