<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_GET['id'])) {
    $pid = $_GET['id'];
    $query = "SELECT * FROM equipment WHERE id='$pid'";
    $result = mysqli_query($con, $query);
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        // Redirect to the product list page if the product with the given ID doesn't exist
        header('location: equipment.php');
        exit;
    }
} else {
    // Redirect to the product list page if no ID is provided
    header('location: equipment.php');
    exit;
}

if (isset($_POST['submit'])) {
    // Get the updated product details from the form
    $equipment_name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $purchace_date = $_POST['purchace_data'];
    $waranty_periods = $_POST['waranty_periods'];
    $brand = $_POST['brand'];
    $supplier = $_POST['supplier'];
    $stock_count = $_POST['stock_count'];

    // Update the product details in the database
    $updateQuery = "UPDATE equipment SET 
        name='$name', 
        description='$description', 
        price='$price', 
        purchace_data='$purchace_date', 
        waranty_periods='$waranty_periods', 
        brand='$brand', 
        supplier='$supplier', 
        stock_count='$stock_count'
        WHERE id='$pid'";
    
    $updateResult = mysqli_query($con, $updateQuery);

    if ($updateResult) {
        echo "<script>alert('Equipment updated successfully');</script>";
    } else {
        echo "<script>alert('Failed to update equipment. Please try again.');</script>";
    }
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>BPMS || Manage Product</title>

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
<!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<!--webfonts-->
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
<!--//webfonts--> 
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<!--//end-animate-->
<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->

<style>
    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        max-width: 500px; /* Adjust the width as needed */
        width: 80%;
        max-height: 90%;
        overflow: auto;
    }

    .close {
        position: absolute;
        top: 10px;
        right: 10px;
        cursor: pointer;
        font-size: 20px;
    }

    /* Style the form labels and input fields */
    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 3px;
        font-size: 14px;
    }

    textarea {
        resize: vertical;
        height: 100px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body class="cbp-spmenu-push">
    <div class="main-content">
        <!--left-fixed -navigation-->
        <?php include_once('includes/sidebar.php');?>
        <!--left-fixed -navigation-->
        <!-- header-starts -->
        <?php include_once('includes/header.php');?>
        <!-- //header-ends -->

        <!-- main content start-->
        <div id="page-wrapper">
            <div class="main-page">
                <div class="tables">
                    <h3 class="title1">Edit Equipment</h3>

                        <div class="table-responsive bs-example widget-shadow">
                            <form method="POST">
                                <label for="name">Equipment Name:</label>
                                <input type="text" id="name" name="name" required value="<?php echo $product['name']; ?>">

                                <label for="description">Equipment Description:</label>
                                <textarea id="description" name="description" required></textarea>

                                <label for="price">Price :</label>
                                <input type="number" id="price" name="price" required>

                                <label for="purchace_date">Purchaced Date:</label>
                                <input type="date" id="purchace_date" name="purchace_date" required>

                                <label for="waranty_periods">Waranty Period:</label>
                                <input type="number" id="waranty_periods" name="waranty_periods" required>

                                <label for="brand">Brand:</label>
                                <input type="text" id="brand" name="brand" required>

                                <label for="supplier">Supplier:</label>
                                <input type="text" id="supplier" name="supplier" required>

                                <label for="stock_in">Stock In:</label>
                                <input type="number" id="stock_count" name="stock_count" required>
                                
                                <input type="submit" name="submit" value="Update Equipment">
                            </form>
                        </div>
                </div>
            </div>
        </div>

        <!--footer-->
        <?php include_once('includes/footer.php');?>
        <!--//footer-->
</div>


<!-- Classie -->
<script src="js/classie.js"></script>
    <script>
        var menuLeft = document.getElementById('cbp-spmenu-s1'),
            showLeftPush = document.getElementById('showLeftPush'),
            body = document.body;

        showLeftPush.onclick = function() {
            classie.toggle(this, 'active');
            classie.toggle(body, 'cbp-spmenu-push-toright');
            classie.toggle(menuLeft, 'cbp-spmenu-open');
            disableOther('showLeftPush');
        };

        function disableOther(button) {
            if (button !== 'showLeftPush') {
                classie.toggle(showLeftPush, 'disabled');
            }
        }
    </script>
    <!--scrolling js-->
    <script src="js/jquery.nicescroll.js"></script>
    <script src="js/scripts.js"></script>
    <!--//scrolling js-->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.js"> </script>

</body>
</html>
