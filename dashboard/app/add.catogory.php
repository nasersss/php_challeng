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
    <div class="row mt-5 mx-0">
        <form action="add.catogory.php" method="post" class="col-8 m-auto h-50">
            <h1 class="t-alin mb-3">Add New Catogory</h1>
            <input type="text" placeholder="Catogory Name" name="cat_name" id="" class="form-control">
            <input type="submit" name=submit class="btn btn-primary my-3 float-end" value="Add">
        </form>
    </div>


    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'e-store');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    if (isset($_POST['submit'])) {
        $cat_name = strtolower($_POST['cat_name']);
        $sql = "insert into category(name) VALUES ('$cat_name')";

        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<p id='alart' class='sess-alart'> New category added successfully <span class='close'>X</span></p>";
        } else {
            $sql = "select * from category where is_active=0 AND name= '$cat_name'";
            $rows = $conn->query($sql);
            if ($row = mysqli_fetch_assoc($rows)) {
                $sql = "UPDATE category SET is_active=1 WHERE is_active=0 AND id=" . $row["id"];
                if (mysqli_query($conn, $sql) === TRUE) {
                    echo "<p id='alart' class='sess-alart'> New category added successfully <span class='close'>X</span></p>";
                } else {
                    echo "<p id='alart' class='err-alart'>This Category is Diplicated <span class='close'>X</span></p>";
                }
            } else
                echo "<p id='alart' class='err-alart'>This Category is Diplicated <span class='close'>X</span></p>";
        }
    }
    if (isset($_GET['submit'])) {
        $sql = "UPDATE category SET is_active=0 WHERE id=" . $_GET['cat_id'];
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<p id='alart' class='sess-alart'> The Catecory you are selected is deleted <span class='close'>X</span></p>";
        } else {
            echo "<p id='alart' class='err-alart'>This Category is Diplicated <span class='close'>X</span></p>";
        }
    }
    if (isset($_GET['true'])){
        echo "<p id='alart' class='sess-alart'> The Category is Updated <span class='close'>X</span></p>";
    }
    $rows = mysqli_query($conn, 'select * from category where is_active=1 ORDER BY id');

    echo "<table class='table mt-5'>
    <tr>
      <th>ID</th>
      <th>Category</th>
      <th></th>
    </tr>";
    while ($row = mysqli_fetch_assoc($rows)) {
        echo "<tr>
        <td>" . $row['id'] . "</td>
        <td>" . ucwords($row['name']) . "</td>
        <td>
                <form action='add.catogory.php' method='get' class='col-8 m-auto h-50'>
                    <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                    <input type='submit' name=submit class='btn btn-danger my-3 float-end btn-sm' value='Delete'>
                </form>
                <form action='update.catogory.php' method='get' class='col-8 m-auto h-50'>
                    <input type='text' placeholder='Catogory Name' hidden value='" . $row['id'] . "' name='cat_id' id='' class='form-control'>
                    <input type='submit' name=submit class='btn btn-info me-2 my-3 float-end btn-sm white' style='color:#fff;' value='Update'>
                </form>
        </td>
  </tr>";
    }


    echo "</table>";

    ?>
    <script>
        const alart = document.getElementById('alart');



        alart.addEventListener('click', () => {
            alart.style.display = "none";
        });
    </script>

</body>

</html>