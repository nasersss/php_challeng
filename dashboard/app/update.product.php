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
    $imag_dir = "../public/images/";
    if (isset($_GET['submit'])) {

        $sql = "select * from product where id=$_GET[cat_id]";
        $rows = $conn->query($sql);
        if ($row = mysqli_fetch_assoc($rows)) {
            echo " <div class='row mt-5 mx-0 '>
            <form action='add.product.php' method='post' class='col-8 m-auto h-50' enctype='multipart/form-data'>
                <h1 class='t-alin mb-3'>Update New Product</h1>
                <input type='text' placeholder='Product Name'  value='$row[name]' name='name' id='' class='my-3 form-control'>
                <input type='number' placeholder='Product Price' value='$row[price]' name='price' id='' class='my-3 form-control'>
                <input type='number' placeholder='Product Quantity' value='$row[quantity]' name='quantity' id='' class='my-3 form-control'>
                <select  name='category_id' class='my-3 form-control' id=''>
                    <option disabled  value=''>Select Category</option>";
    
                    $sql = "select * from category where is_active=1";
                    $categoris = $conn->query($sql);
                    while ($category = mysqli_fetch_assoc($categoris)) {
                        if($category['id']===$row['cat_id']){
                            echo "<option selected value='$category[id]'>$category[name]</option>";
                        }else{
                            echo "<option value='$category[id]'>$category[name]</option>";
                        }
                        
                    }
                echo "</select>
                <input type='submit' name='submit' class='btn btn-primary my-3 float-end' value='Update'>
            </form>
        </div>
    ";
        } else
            echo "<p id='alart' class='err-alart'>This Category is Note Found <span class='close'>X</span></p>";
    }
    if (isset($_POST['submit'])) {
        $pro_name = strtolower($_POST['name']);
        $url = "./add.product.php?true=true";
        $sql = "UPDATE product SET name=$pro_name,price=$_POST[price],quantity=$_POST[quantity],cat_id=$_POST[category_id] WHERE is_active=0 AND id=" . $row["id"];
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<p id='alart' class='sess-alart'> New product added successfully <span class='close'>X</span></p>";
            header('Location: ' . $url);
        } else {
            $sql = "select * from category where id=$_POST[cat_id]";
            $rows = $conn->query($sql);
            if ($row = mysqli_fetch_assoc($rows)) {
                echo " <div class='row mt-5 mx-0 '>
            <form action='add.product.php' method='post' class='col-8 m-auto h-50' enctype='multipart/form-data'>
                <h1 class='t-alin mb-3'>Update New Product</h1>
                <input type='text' placeholder='Product Name'  value='$row[name]' name='name' id='' class='my-3 form-control'>
                <input type='number' placeholder='Product Price' value='$row[price]' name='price' id='' class='my-3 form-control'>
                <input type='number' placeholder='Product Quantity' value='$row[quantity]' name='quantity' id='' class='my-3 form-control'>
                <select  name='category_id' class='my-3 form-control' id=''>
                    <option disabled  value=''>Select Category</option>";
    
                    $sql = "select * from category where is_active=1";
                    $categoris = $conn->query($sql);
                    while ($category = mysqli_fetch_assoc($categoris)) {
                        if($category['id']===$row['cat_id']){
                            echo "<option selected value='$category[id]'>$category[name]</option>";
                        }else{
                            echo "<option value='$category[id]'>$category[name]</option>";
                        }
                        
                    }
                echo "</select>
                <input type='submit' name='submit' class='btn btn-primary my-3 float-end' value='Upadte'>
            </form>
        </div>
    ";
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