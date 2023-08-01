<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsaid'])==0) {
    header('location:logout.php');
} else 
    if (isset($_GET['delid'])) {
        $pid = $_GET['delid'];
        mysqli_query($con, "DELETE FROM equipment WHERE id='$pid'");
        echo "<script>alert('Equipment Deleted');</script>";
        echo "<script>window.location.href='equipment.php'</script>";
    }
?>

// Fetch the latest equipment data from the database
$query = "SELECT * FROM equipment";
$result = mysqli_query($con, $query);

// Render the table
echo '<table class="table table-bordered" id="equipmentTable">';
echo '<thead>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Name</th>';
echo '<th>Description</th>';
echo '<th>Price</th>';
echo '<th>Purchaced Date</th>';
echo '<th>Waranty Period</th>';
echo '<th>Brand</th>';
echo '<th>Supplier</th>';
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
    echo '<td>' . $row['purchace_data'] . '</td>';
    echo '<td>' . $row['waranty_periods'] . '</td>';
    echo '<td>' . $row['brand'] . '</td>';
    echo '<td>' . $row['supplier'] . '</td>';
    echo '<td>' . $row['stock_count'] . '</td>';
    echo '<td>';
    echo '<a href="edit_equipment.php?id=' . $row['id'] . '">Edit</a> | ';
    echo '<a href="equipment.php?delid=' . $row['id'] . '" onclick="return confirm(\'Are you sure you want to delete this equipment?\'">Delete</a>';
    echo '</td>';
    echo '</tr>';
}

echo '</tbody>';
echo '</table>';
?>
