<?php

require_once('connect.php');
$query = " select * from products";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetcher</title>
    <link rel="stylesheet" href="./CSS/FetchData.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h2>Fetcher</h2>
                    </div>
                <div class="card-body">
                    <table class="table-container">
                        <tr>
                            <td>Product ID</td>
                            <td>Product Name</td>
                            <td>Product Price</td>
                            <td>Product InStock</td>
                            <td>Product Category</td>
                            <td>Model Number</td>
                            <td>Edit</td>
                        </tr>
                        <tr>
                            <?php
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <td><?php echo $row['product_id']?></td>
                            <td><?php echo $row['name']?></td>
                            <td><?php echo $row['price']?></td>
                            <td><?php echo $row['in_stock']?></td>
                            <td><?php echo $row['category']?></td>
                            <td><?php echo $row['model_number']?></td>
                            <td><?php echo '<a href="FetchEditer.php?product_id=' . $row['product_id'] . '">Edit</a>'; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>


</body>
</html>