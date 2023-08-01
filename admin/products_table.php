<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'])==0) {
    header('location:logout.php');
} else 
    if (isset($_GET['delid'])) {
        $pid = $_GET['delid'];
        mysqli_query($con, "DELETE FROM products WHERE id='$pid'");
        echo "<script>alert('Product Deleted');</script>";
        echo "<script>window.location.href='products.php'</script>";
    }
?>

// Fetch the latest product data from the database
$query = "SELECT * FROM products";
$result = mysqli_query($con, $query);

// Render the table
echo '<table class="table table-bordered" id="productsTable">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '<th>Suppliers</th>';
echo '<th>Batch No</th>';
echo '<th>Expiration Date</th>';
echo '<th>Manufacturing Date</th>';
echo '<th>Stock_In</th>';
echo '<th>Action</th>';
echo '</tr>';
echo '</thead>';
echo '<tbody>';

while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . $row['name'] . '</td>';
    echo '<td>' . $row['description'] . '</td>';
    echo '<td>' . $row['price'] . '</td>';
    echo '<td>' . $row['supplier'] . '</td>';
    echo '<td>' . $row['batch_no'] . '</td>';
    echo '<td>' . $row['exp_date'] . '</td>';
    echo '<td>' . $row['manufac_date'] . '</td>';
    echo '<td>' . $row['stock_count'] . '</td>';
    echo '<td>';
    echo '<a href="edit_product.php?id=' . $row['id'] . '">Edit</a> | ';
    echo '<a href="products.php?delid=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>
