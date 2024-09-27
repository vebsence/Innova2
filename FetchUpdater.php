<?php

require 'connect.php';

if (isset($_POST['update'])) {

	$id = $_POST['product_id'];
	$name = $_POST['productName'];
	$price = $_POST['productPrice'];
	$discount = $_POST['productDiscount'];	
    $instock = $_POST['inStock'];
    $category = $_POST['productCategory'];
    $description = $_POST['productDesc'];

    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $images = $_FILES['images'] ?? [];
    $targetDirectory = "C:/Users/achan/Desktop/Innova-main/Innova za Prezentacija/UPLOADED_IMAGES/";
    $images_array[] = [];


    if (!empty($images)) {
        foreach ($_FILES['images']['name'] as $key => $file_name) {
            $tmpName = $_FILES['images']['tmp_name'][$key];
            $fileName = basename($file_name);
    
            $targetFilePath = $targetDirectory.$fileName;
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                echo "File $fileName uploaded successfully.<br>";
                $images_array[] = $targetFilePath;
            } else {
                $images_array[] = null;
                echo "Failed to upload $fileName.<br>";
            }
        }
    }

    echo "<br></br>";
    print_r($images_array);
    echo "<br></br>";

    $brand = $_POST['brand-value'];
    $series = $_POST['series-value'];
    $modelNumber = $_POST['modelnumber-value'];
    $weight = $_POST['weight-value'];
    $dimensions = $_POST['dimensions-value'];
    $color = $_POST['color-value'];
    $manufactuer = $_POST['manufactuer-value'];
    $origin = $_POST['origin-value'];
    $firstDate = $_POST['firstDate-value'];

    $energy = $_POST['energy-value'] ?? '';
    $volts = $_POST['volts-value'] ?? '';
    $memorySpeed = $_POST['memorySpeed-value'] ?? '';
    $usb3 = $_POST['usb3-value'] ?? '';
    $usb2 = $_POST['usb2-value'] ?? '';
    $processorBrand = $_POST['processorBrand-value'] ?? '';
    $numProcess = $_POST['numProcess-value'] ?? '';
    $typeMem = $_POST['typeMem-value'] ?? '';
    $HardDD = $_POST['HardDD-value'] ?? '';
    $HardPlat = $_POST['HardPlat-value'] ?? '';
    $HardFlash = $_POST['HardFlash-value'] ?? '';
    $HardInterface = $_POST['HardInterface-value'] ?? '';
    $gpuRAM = $_POST['gpuRAM-value'] ?? '';
    $motherboardRAM = $_POST['motherboardRAM-value'] ?? '';
    $matherboardType = $_POST['matherboardType-value'] ?? '';
    $screenSize = $_POST['screenSize-value'] ?? '';
    $screenRes = $_POST['screenRes-value'] ?? '';
    $screenMax = $_POST['screenMax-value'] ?? '';

    $image1 = isset($images_array[1]) ? $images_array[1] : $row['image1'];
    $image2 = isset($images_array[2]) ? $images_array[2] : $row['image2'];
    $image3 = isset($images_array[3]) ? $images_array[3] : $row['image3'];
    $image4 = isset($images_array[4]) ? $images_array[4] : $row['image4'];

	
	if (empty($name) || empty($price) || empty($discount)) {
		if (empty($name)) {
			echo "<font color='red'>name field is empty.</font><br/>";
		}
		
		if (empty($price)) {
			echo "<font color='red'>price field is empty.</font><br/>";
		}
		
		if (empty($discount)) {
			echo "<font color='red'>discount field is empty.</font><br/>";
		}
	} 
    else {
        $stmt = $conn->prepare("UPDATE products SET 
        name = ?, 
        price = ?, 
        discount = ?, 
        in_stock = ?, 
        category = ?, 
        description = ?,
        image1 = ?,
        image2 = ?,
        image3 = ?, 
        image4 = ?,
        brand = ?, 
        series = ?, 
        model_number = ?, 
        weight = ?, 
        dimensions = ?, 
        color = ?, 
        manufactuer = ?, 
        origin = ?, 
        firstDate = ?, 
        energy = ?, 
        volts = ?, 
        memorySpeed = ?, 
        usb3 = ?, 
        usb2 = ?, 
        processorBrand = ?, 
        numProcess = ?, 
        typeMem = ?, 
        HardDD = ?, 
        HardPlat = ?, 
        HardFlash = ?, 
        HardInterface = ?, 
        gpuRAM = ?, 
        motherboardRam = ?, 
        matherboardType = ?, 
        screenSize = ?, 
        screenRes = ?, 
        screenMax = ? 
        WHERE product_id = ?;"
        );

        echo $images_array[1];

        $stmt->bind_param(
            "ssdissssssssssssssssiiiisisssssiissssi", 
            $name, $price, $discount, $instock, $category, $description, $image1, $image2,
            $image3, $image4, $brand, $series, 
            $modelNumber, $weight, $dimensions, $color, $manufactuer, $origin, $firstDate, 
            $energy, $volts, $memorySpeed, $usb3, $usb2, $processorBrand, $numProcess, 
            $typeMem, $HardDD, $HardPlat, $HardFlash, $HardInterface, $gpuRAM, 
            $motherboardRAM, $matherboardType, $screenSize, $screenRes, $screenMax, $id);
        
        if ($stmt->execute()) {
            echo "<p><font color='green'>Data updated successfully!</font></p>";
        } else {
            echo "<p><font color='red'>Error updating data: " . $conn->error . "</font></p>";
        }

        $stmt->close();
	}
    }
else {
    
}
?>
<p><a href="FetchData.php">View Updated Data</a></p>
