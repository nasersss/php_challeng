<?php
$conn = mysqli_connect('localhost', 'root', '', 'e-store');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$imag_dir = "../public/images/";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/bootstrap-5.1.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../public/css/bootstrap-5.1.3-dist/css/bootstrap.css.map">
    <link rel="stylesheet" href="../public/css/style.css">
    <title>New product</title>
    <style>

    </style>
</head>

<body>

    <div class="row mt-5 mx-0 ">
        <form action="add.product.php" method="post" class="col-8 m-auto h-50" enctype="multipart/form-data">
            <h1 class="t-alin mb-3">Add New Product</h1>
            <input type="text" placeholder="Product Name" name="name" id="" class="my-3 form-control">
            <input type="number" placeholder="Product Price" name="price" id="" class="my-3 form-control">
            <input type="number" placeholder="Product Quantity" name="quantity" id="" class="my-3 form-control">
            <input type="file" name="product_image" class="my-3 form-control">
            <select name="category_id" class="my-3 form-control" id="">
                <option disabled selected value="">Select Category</option>
                <?php

                $sql = "select * from category where is_active=1";
                $rows = $conn->query($sql);
                while ($row = mysqli_fetch_assoc($rows)) {
                    echo "<option value='$row[id]'>$row[name]</option>";
                } ?>
            </select>
            <input type="submit" name='submit' class="btn btn-primary my-3 float-end" value="Add">
        </form>
    </div>


    <?php

    if (isset($_POST['submit'])) {
        if (isset($_FILES['product_image'])) {

            $file_type = explode(".", $_FILES['product_image']["name"]);
            $ext = end($file_type);
            $allowed_ext = array('png', 'jpg', 'jpeg');
            if (in_array($ext, $allowed_ext)) {
                $new_name = time() . rand(1000000, 10000000) . '.' . $ext;
                $name = strtolower($_POST['name']);
                $sql = "insert into product(name,price,quantity,imag,cat_id) VALUES ('$name',$_POST[price],$_POST[quantity],'$new_name',$_POST[category_id])";
                if (mysqli_query($conn, $sql) === TRUE) {
                    echo "<p id='alart' class='sess-alart'> New product added successfully <span class='close'>X</span></p>";
                    move_uploaded_file($_FILES['product_image']['tmp_name'], $imag_dir . $new_name);
                } else {
                    $sql = "select * from product where is_active=0 AND name= '$name'";
                    $rows = $conn->query($sql);
                    if ($row = mysqli_fetch_assoc($rows)) {
                        $sql = "UPDATE product SET is_active=1,price=$_POST[price],quantity=$_POST[quantity],imag=$new_name,cat_id=$_POST[category_id] WHERE is_active=0 AND id=" . $row["id"];
                        if (mysqli_query($conn, $sql) === TRUE) {
                            echo "<p id='alart' class='sess-alart'> New product added successfully <span class='close'>X</span></p>";
                            move_uploaded_file($_FILES['product_image']['tmp_name'], $imag_dir . $new_name);
                        } else {
                            echo "<p id='alart' class='err-alart'>This product is Diplicated <span class='close'>X</span></p>";
                        }
                    } else
                        echo "<p id='alart' class='err-alart'>This product is Diplicated <span class='close'>X</span></p>";
                }
            } else
                echo "<p id='alart' class='err-alart'>This Extention is Not Supported <span class='close'>X</span></p>";
        }
    }
    if (isset($_GET['submit'])) {
        $sql = "UPDATE product SET is_active=0 WHERE id=" . $_GET['cat_id'];
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<p id='alart' class='sess-alart'> The product you are selected is deleted <span class='close'>X</span></p>";
        } else {
            echo "<p id='alart' class='err-alart'>This product is Diplicated <span class='close'>X</span></p>";
        }
    }
    if (isset($_GET['true'])) {
        echo "<p id='alart' class='sess-alart'> The product is Updated <span class='close'>X</span></p>";
    }
    $rows = mysqli_query($conn, 'select * from product where is_active=1 ORDER BY id');

    echo "<div class='row m-auto' style='width: 80%'>";


    while ($row = mysqli_fetch_assoc($rows)) {
        $sql = "select * from category where id=$row[cat_id]";
        $categoris = $conn->query($sql);
        if ($category = mysqli_fetch_assoc($categoris)) {
            echo "<div class='card m-2' style='width: 17rem;'>
                    <img src='" . $imag_dir . $row['imag'] . "' class='card-img-top' alt='...'>
                    <div class='card-body'>
                    <h5 class='card-title'>$row[name]</h5>
                    <p class='card-text'>price: <b>$row[price]</b> <br> quantity: <b>$row[quantity]</b> <br> category: <b>$category[name]</b></p>
                        <div class='w-75 d-flex '>
                            <form action='add.product.php' method='get' class='col-8 m-auto h-50'>
                                <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                                <input type='submit' name=submit class='btn btn-danger my-3 float-end btn-sm' value='Delete'>
                            </form>
                            <form action='update.product.php' method='get' class='col-8 m-auto h-50'>
                                <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                                <input type='submit' name=submit class='btn btn-info me-2 my-3 float-end btn-sm white' style='color:#fff;' value='Update'>
                            </form>
                        </div>
                    </div>
                </div>";
        }
    }


    echo "</div>";

    ?>
    <script>
        const alart = document.getElementById('alart');
        alart.addEventListener('click', () => {
            alart.style.display = "none";
        });
    </script>

</body>

</html>