<?

require 'connect.php';

if (isset($_GET['product_id'])) {
    
    $param = $_GET['product_id'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param('i', $param);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        //foreach ($row as $column => $value) {
            //echo htmlspecialchars($column) . ": " . htmlspecialchars($value) . "<br>";
        //}

        $product_name = $row['name'];
        $product_price = $row['price'];
        $product_discount = $row['discount'];
        $product_inStock = $row['in_stock'];
        $product_category = $row['category'];
        $product_description = $row['description'];
        if($row['image1'] != null) {
            $first_image = basename(strrchr($row['image1'], '/'));
        }
        if($row['image2'] != null) {
            $second_image = basename(strrchr($row['image2'], '/'));
        }
        if($row['image3'] != null) {
            $third_image = basename(strrchr($row['image3'], '/'));
        }
        if($row['image4'] != null) {
            $fourth_image = basename(strrchr($row['image4'], '/'));
        }

        $brand = $row['brand'];
        $series = $row['series'];
        $model_number = $row['model_number'];
        $weight = $row['weight'];
        $dimensions = $row['dimensions'];
        $color = $row['color'];
        $manufactuer = $row['manufactuer'];
        $origin = $row['origin'];
        $firstDate = $row['firstDate'];

        ?>

        <?php
            $discountAmount = $product_price * ($product_discount / 100);
            $newPrice = $product_price - $discountAmount; 
        ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($productName) ? htmlspecialchars($productName) : 'Product Page'; ?></title>
    <!-- css -->
     <link rel="stylesheet" href="/CSS/Header.css">
    <link rel="stylesheet" href="/CSS/ProductPage.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>

          <!-- NAVIGATION MENU -->
          <header>
            <a href="#" class="logo"><img src="image/NewLogo.png"></a>
    
            <ul class="navigationmenu">
                <li><a href="./Home.html">home</a></li>
                <li class="dropdown-list"><a href="#">products</a>
                    <ul class="dropdown-menu">
                        <li>Процесори</li>
                        <li>Графички</li>
                        <li>Матични</li>
                        <li>Напојувања</li>
                        <li>Монитори</li>
                        <li>Периферии</li>
                        <li>Куќишта</li>
                        <li>Дата</li>
                    </ul>
                </li>
                
                <li><a href="#">wishlist</a></li>
                <li><a href="../Home.html#discounted">Featured</a></li>
            </ul>
    
            <div class="nav-icon">
                <a href=""></a>
                <a href=""><i class='bx bx-user' ></i></a>
                <a href="/Cart.html"><i class='bx bx-cart' ></i></a>
            </div>
        </header>
        <!-- NAVIGATION MENU -->
        <section>
            <div class="pagination">
                <p>Home > Products > <?php echo $product_category?> >
                <?php echo $product_name ?> 
                </p>
            </div>
        </section>

        <section class="product-container">
        <!-- left side -->
        <div class="img-card">
            <img src="/UPLOADED_IMAGES/<?php echo $first_image ?>" alt="" id="featured-image">
            <!-- small img -->
            <div class="small-Card">
                <img src="/UPLOADED_IMAGES/<?php echo $first_image?>" alt="" class="small-Img">
                <img src="/UPLOADED_IMAGES/<?php echo $second_image ?>" alt="" class="small-Img">
                <img src="/UPLOADED_IMAGES/<?php echo $third_image ?>" alt="" class="small-Img">
                <img src="/UPLOADED_IMAGES/<?php echo $fourth_image ?>" alt="" class="small-Img">
            </div>
        </div>
        <!-- Right side -->
        <div class="product-info">
            <h3><?php echo $product_name ?></h3>
            <div class="info__pricing">
                <span class="info__pricing--price"><?php echo $newPrice ?></span>
                <?php
                if($product_discount > 0){
                    echo '<span class="info__pricing--discount">';
                    echo $product_discount."%</span>";
                    echo '<span class="info__pricing--before"><strike>';
                    echo $product_price."</strike></span>";
                }
                ?>
            </div>
            <p><?php echo $product_description ?></p>
            <div class="quantity">
                <input type="number" value="1" min="1">
                <button>Add to Cart</button>
            </div>

            <div class="isAvailable">
                <?php
                    if($product_inStock) {
                        echo '<p>На залиха<i class=\'bx bx-check\'></i></p>';
                    }
                    else {
                        echo '<p>На залиха<i class=\'bx bx-x\' ></i></p>';
                    }
                ?>
            </div>

            <div>
                <p>Delivery:</p>
                <p>Free standard shipping on orders over $35 before tax, plus free returns.</p>
                <div class="delivery">
                    <p>TYPE</p> <p>HOW LONG</p> <p>HOW MUCH</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Standard delivery</p> 
                    <p>1-4 business days</p> 
                    <p>$4.50</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Express delivery</p> 
                    <p>1 business day</p> 
                    <p>$10.00</p>
                </div>
                <hr>
                <div class="delivery">
                    <p>Pick up in store</p> 
                    <p>1-3 business days</p> 
                    <p>Free</p>
                </div>
            </div>
        </div>
    </section>

        <!-- PRODUCT DESCRIPTION & INFORMATION -->
    <section style="width: 50%; margin-left: auto; margin-right: auto">
        <div class="center-text">
            <h2>Oпис</h2>
        </div>

        <div class="table-container">
        <div class="product-info-first">
            <table id="first-table" class="product-table">
            <?php

            $count = 0;
            foreach($row as $column => $value) {

                if($count > 10) {
                    if(isset($value) && $value != '') {
                        echo '<tr>';
                        echo '<th style="text-transform: capitalize;">'.$column.'</th>';
                        echo '<td>'.$value.'</td>';
                        echo '</tr>';
                    }
                }

                ++$count;
            }
            ?>
            </table>
        </div>
    </div>
</section>

    <!-- script tags -->
    <script src="ProductPage.js"></script>
    </body>
</html>
    <?php
    }
    else {
        echo "NE POSTOI OVOJ PRODUCT";
    }
}
else {
    echo "Parameter 'param' is not passed.";
    header("Location: /Products%20HTML/Monitor.html");
}



