<?php

require 'connect.php';

$id = $_GET['product_id'];

$stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$id = isset($row['product_id']) ? $row['product_id'] : '';
$name = isset($row['name']) ? $row['name'] : '';
$price = isset($row['price']) ? $row['price'] : '';
$discount = isset($row['discount']) ? $row['discount'] : '';
$instock = isset($row['instock']) ? $row['instock'] : '';
$category = isset($row['category']) ? $row['category'] : '';
$description = isset($row['description']) ? $row['description'] : '';

$image1 = $row['image1'];
$image2 = $row['image2'];
$image3 = $row['image3'];
$image4 = $row['image4'];

//OPIS
$brand = isset($row['brand']) ? $row['brand'] : '';
$series = isset($row['series']) ? $row['series'] : '';
$modelNumber = isset($row['model_number']) ? $row['model_number'] : '';
$weight = isset($row['weight']) ? $row['weight'] : '';
$dimensions = isset($row['dimensions']) ? $row['dimensions'] : '';
$color = isset($row['color']) ? $row['color'] : '';
$manufactuer = isset($row['manufactuer']) ? $row['manufactuer'] : '';
$origin = isset($row['origin']) ? $row['origin'] : '';
$firstDate = isset($row['firstDate']) ? $row['firstDate'] : '';
$energy = isset($row['energy']) ? $row['energy'] : '';
$volts = isset($row['volts']) ? $row['volts'] : '';
$memorySpeed = isset($row['memorySpeed']) ? $row['memorySpeed'] : '';
$usb3 = isset($row['usb3']) ? $row['usb3'] : '';
$usb2 = isset($row['usb2']) ? $row['usb2'] : '';
$processorBrand = isset($row['processorBrand']) ? $row['processorBrand'] : '';
$numProcess = isset($row['numProcess']) ? $row['numProcess'] : '';
$typeMem = isset($row['typeMem']) ? $row['typeMem'] : '';
$HardDD = isset($row['HardDD']) ? $row['HardDD'] : '';
$HardPlat = isset($row['HardPlat']) ? $row['HardPlat'] : '';
$HardFlash = isset($row['HardFlash']) ? $row['HardFlash'] : '';
$HardInterface = isset($row['HardInterface']) ? $row['HardInterface'] : '';
$gpuRAM = isset($row['gpuRAM']) ? $row['gpuRAM'] : '';
$motherboardRAM = isset($row['motherboardRAM']) ? $row['motherboardRAM'] : '';
$matherboardType = isset($row['matherboardType']) ? $row['matherboardType'] : '';
$screenSize = isset($row['screenSize']) ? $row['screenSize'] : '';
$screenRes = isset($row['screenRes']) ? $row['screenRes'] : '';
$screenMax = isset($row['screenMax']) ? $row['screenMax'] : '';

?>
<html>
<head>	
	<title>Edit Data</title>
    <link rel="stylesheet" href="./CSS/AddProduct.css">
</head>
<style>
    .file-input-container {
        margin-bottom: 20px;
        margin-right: 25px;
        width: 100px;
    }

    .file-input-container label {
        display: block; 
        width: auto;
        font-size: 14px; 
    }
</style>
<body>
    <h2 style="text-align: center">Edit Data</h2>
    <p>
	    <a href="FetchData.php">Home</a>
    </p>

    <form name="edit" method="post" action="FetchUpdater.php" enctype="multipart/form-data">
    <div class="container">
        <div class="productinfo">
            <label>
                PRODUCT ID:
            </label>
            <input type="number" name="product_id" value="<?php echo $id ?>">
            <label>Name</label>
            <input type="text" name="productName" value="<?php echo $name; ?>" required>
            <label>Price</label>
            <input type="number" name="productPrice" value="<?php echo $price; ?>" required>
            <label>Discount</label>
            <input type="number" name="productDiscount" min="0" max="70" value="<?php echo $discount; ?>" required>
            <label>inStock</label>
            <select name="inStock" value="<?php echo $instock; ?>">
                <option value="false">No</option>
                <option value="true">Yes</option>
            </select>
            <label>Category</label>
            <select name="productCategory" value="<?php echo $category; ?>">
                <option value="CPU">CPU</option>
                <option value="GPU">GPU</option>
                <option value="Motherboard">Motherboard</option>
                <option value="Power-Supply">Power Supply</option>
                <option value="Monitor">Monitor</option>
                <option value="Periferii">Periferii</option>
                <option value="Cases">Cases</option>
                <option value="Data">Data</option>
            </select>
            <label>Description</label>
            <textarea name="productDesc" required><?php echo $description; ?> </textarea>
            <!-- IMAGES -->
             <div class="imageCon">
                <label>Images</label>
                <div class="file-input-container">
                    <input type="file" name="images[]" id="filechooser">
                    <label style="font-size: 14px;"> <?php if(isset($image1)){echo $image1;} ?> </label>
                </div>
                <div class="file-input-container">
                    <input type="file" name="images[]" id="filechooser">
                    <label style="font-size: 14px;"> <?php if(isset($image2)){echo $image2;} ?> </label>
                </div>
                <div class="file-input-container">
                    <input type="file" name="images[]" id="filechooser">
                    <label style="font-size: 14px;"><?php if(isset($image3)){echo $image3;} ?> </label>
                </div>
                <div class="file-input-container">
                    <input type="file" name="images[]" id="filechooser">
                    <label style="font-size: 14px;"><?php if(isset($image4)){echo $image4;} ?> </label>
                </div>
            </div>
            <!-- IMAGES --> 
        </div>

            <ul id="myUL">
            <li><span class="opisList">Опис</span>
              <ul class="nested">
                <li>
                  <input type="checkbox" class="toggle-input" name="brand" checked>Бренд
                  <input type="text" class="text-field" name="brand-value" value="<?php echo $brand; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="series" checked>Серија
                  <input type="text" class="text-field" name="series-value" value="<?php echo $series; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="modelNumber" checked>Број на модел
                  <input type="text" class="text-field" name="modelnumber-value" value="<?php echo $modelNumber; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="weight" checked>Тежина
                  <input type="text" class="text-field" name="weight-value" value="<?php echo $weight; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="dimensions" checked>Димензии на производот
                  <input type="text" class="text-field" name="dimensions-value" value="<?php echo $dimensions; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="color" checked>Боја
                  <input type="text" class="text-field" name="color-value" value="<?php echo $color;?>" >
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="manufactuer" checked>Производител
                  <input type="text" class="text-field" name="manufactuer-value" value="<?php echo $manufactuer; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="origin" checked>Земја на потекло
                  <input type="text" class="text-field" name="origin-value" value="<?php echo $origin; ?>">
                </li>
                <li>
                  <input type="checkbox" class="toggle-input" name="firstDate" checked>Прво достапен на датум
                  <input type="text" class="text-field" name="firstDate-value" value="<?php echo $firstDate; ?>">
                </li>
                <li><span class="opisList">More</span>
                  <ul class="nested">
                    <li>
                      <input type="checkbox" class="toggle-input" name="energy">Извор на енергија
                      <input type="text" class="text-field" name="energy-value" value="<?php echo $energy; ?>">
                    </li>
                    <li>
                      <input type="checkbox" class="toggle-input" name="volts">Волти
                      <input type="number" class="text-field" name="volts-value" value="<?php echo $volts; ?>">
                    </li>
                    <li>
                      <input type="checkbox" class="toggle-input" name="memorySpeed">Брзина на меморија
                      <input type="text" class="text-field" name="memorySpeed-value" value="<?php echo $memorySpeed; ?>">
                    </li>
                    <li>
                      <input type="checkbox" class="toggle-input" name="usb3">Број на USB 3.0 порти
                      <input type="number" class="text-field" name="usb3-value" value="<?php echo $usb3; ?>">
                    </li>
                    <li>
                      <input type="checkbox" class="toggle-input" name="usb2">Број на USB 2.0 порти
                      <input type="number" class="text-field" name="usb2-value" value="<?php echo $usb2; ?>">
                    </li>
                    <li><span class="opisList">Процесор</span>
                        <ul class="nested">
                            <li>
                              <input type="checkbox" class="toggle-input" name="processorBrand">Бренд на процесор
                              <input type="text" class="text-field" name="processorBrand-value" value="<?php echo $processorBrand; ?>">
                            </li>
                            <li>
                              <input type="checkbox" class="toggle-input" name="numProcess">Number of Processors
                              <input type="number" class="text-field" name="numProcess-value" value="<?php echo $numProcess; ?>">
                            </li>
                            <li>
                              <input type="checkbox" class="toggle-input" name="typeMem">Тип на меморија на компјутер
                              <input type="text" class="text-field" name="typeMem-value" value="<?php echo $typeMem; ?>">
                            </li>
                          </ul>
                    </li>
                    <li><span class="opisList">Disks</span>
                      <ul class="nested">
                        <li>
                          <input type="checkbox" class="toggle-input" name="HardDD">Hard Drive
                          <input type="text" class="text-field" name="HardDD-value" value="<?php echo $HardDD; ?>">
                        </li>
                        <li>
                          <input type="checkbox" class="toggle-input" name="HardPlat">Hardware Platform
                          <input type="text" class="text-field" name="HardPlat-value" value="<?php echo $HardPlat; ?>">
                        </li>
                        <li>
                          <input type="checkbox" class="toggle-input" name="HardFlash">Flash Memory Size
                          <input type="text" class="text-field" name="HardFlash-value" value="<?php echo $HardFlash; ?>">
                        </li>
                        <li>
                          <input type="checkbox" class="toggle-input" name="HardInterface">Hard Drive Interface
                          <input type="text" class="text-field" name="HardInterface-value" value="<?php echo $HardInterface; ?>">
                        </li>
                      </ul>
                    <li><span class="opisList">GPU</span>
                        <ul class="nested">
                            <li>
                              <input type="checkbox" class="toggle-input" name="gpuRAM">Graphics Card Ram Size
                              <input type="number" class="text-field" name="gpuRAM-value" value="<?php echo $gpuRAM; ?>">
                            </li>
                          </ul>
                    </li>
                    <li><span class="opisList">Motherboard</span>
                        <ul class="nested">
                            <li>
                              <input type="checkbox" class="toggle-input" name="motherboardRAM">RAM
                              <input type="number" class="text-field" name="motherboardRAM-value" value="<?php echo $motherboardRAM; ?>">
                            </li>
                            <li>
                              <input type="checkbox" class="toggle-input" name="matherboardType">Wireless Type
                              <input type="text" class="text-field" name="matherboardType-value" value="<?php echo $matherboardType; ?>">
                            </li>
                          </ul>
                    </li>
                    <li><span class="opisList">Monitor</span>
                        <ul class="nested">
                            <li>
                              <input type="checkbox" class="toggle-input" name="screenSize">Големина на екран
                              <input type="text" class="text-field" name="screenSize-value" value="<?php echo $screenSize; ?>">
                            </li>
                            <li>
                              <input type="checkbox" class="toggle-input" name="screenRes">Резолуција на екранот
                              <input type="text" class="text-field" name="screenRes-value" value="<?php echo $screenRes; ?>">
                            </li>
                            <li>
                              <input type="checkbox" class="toggle-input" name="screenMax">Максимална резолуција на екранот
                              <input type="text" class="text-field" name="screenMax-value" value="<?php echo $screenMax; ?>">
                            </li>
                          </ul>
                    </li>
                  </ul>
                </li>  
              </ul>
            </li>
          </ul>
          <button type="submit" class="btn-new-product" value="update" name="update">Confirm</button>
        </div>
    </form>

<script>
    var toggler = document.getElementsByClassName("opisList");
    var i;
        
    for (i = 0; i < toggler.length; i++) {
        toggler[i].addEventListener("click", function() {
        this.parentElement.querySelector(".nested").classList.toggle("active");
         this.classList.toggle("opisList-down");
        });
    }


</script>
</body>
</html>