<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_POST['submit'])) {
    // Retrieve the data submitted via the form
    $equipment_name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $purchace_date = $_POST['purchace_data'];
    $waranty_periods = $_POST['waranty_periods'];
    $brand = $_POST['brand'];
    $supplier = $_POST['supplier'];
    $stock_count = $_POST['stock_count'];

    // Perform validation if required (e.g., check for empty fields or format validation)

    // Insert data into the database
    $query = "INSERT INTO equipment (name, description, price, purchace_data,waranty_periods, brand, supplier, stock_count )
              VALUES ('$equipment_name', '$description', '$price', '$purchace_date', '$waranty_periods', '$brand', '$supplier', '$stock_count')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // On successful insertion, send a response to the JavaScript script
        echo "success";
    } else {
        // If the insertion fails, send an error response to the JavaScript script
        echo "error";
    }
}
?>
