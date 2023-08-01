<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $suppliers = $_POST['suppliers'];
    $batch_no = $_POST['batch_no'];
    $expiration_date = $_POST['exp_date'];
    $manufacturing_date = $_POST['manufac_date'];
    $stock_in = $_POST['stock_count'];

    // Perform validation if required (e.g., check for empty fields)

    // Insert data into the database
    $query = "INSERT INTO products (name, description, price, supplier, batch_no, exp_date, manufac_date, stock_count)
              VALUES ('$name', '$description', '$price', '$suppliers', '$batch_no', '$expiration_date', '$manufacturing_date', '$stock_in')";
    $result = mysqli_query($con, $query);

    if ($result) {
        // On successful insertion, send a response to the JavaScript script
        echo "success";
    } else {
        echo "error";
    }
}
?>
