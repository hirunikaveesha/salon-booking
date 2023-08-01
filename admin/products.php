<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (strlen($_SESSION['bpmsaid']) == 0) {
    header('location:logout.php');
    exit;
}

if (isset($_GET['delid'])) {
    $pid = $_GET['delid'];
    mysqli_query($con, "DELETE FROM products WHERE id='$pid'");
    echo "<script>alert('Product Deleted');</script>";
    echo "<script>window.location.href='products.php'</script>";
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
                    <h3 class="title1">Manage Products</h3>
                    
                    <div class="table-responsive bs-example widget-shadow">
                        <!-- Products Table -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Suppliers</th>
                                    <th>Batch No</th>
                                    <th>Expiration Date</th>
                                    <th>Manufacturing Date</th>
                                    <th>Stock_In</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT * FROM products";
                                $result = mysqli_query($con, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>{$row['id']}</td>";
                                    echo "<td>{$row['name']}</td>";
                                    echo "<td>{$row['description']}</td>";
                                    echo "<td>{$row['price']}</td>";
                                    echo "<td>{$row['supplier']}</td>";
                                    echo "<td>{$row['batch_no']}</td>";
                                    echo "<td>{$row['exp_date']}</td>";
                                    echo "<td>{$row['manufac_date']}</td>";
                                    echo "<td>{$row['stock_count']}</td>";
                                    echo "<td>
                                            <a href='edit_product.php?id={$row['id']}'>Edit</a> |
                                            <a href='products.php?delid={$row['id']}' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a>
                                          </td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Add Product Button -->
            <button id="addProductBtn" class="btn btn-primary">Add Product</button>
        </div>
            
        <!-- Form Modal -->
        <div id="productModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <form id="productForm" method="POST">
                    <label for="name">Product Name:</label>
                    <input type="text" id="name" name="name" required>

                    <label for="description">Product Description:</label>
                    <textarea id="description" name="description" required></textarea>

                    <label for="price">Price (SL Rupees):</label>
                    <input type="number" id="price" name="price" required>

                    <label for="suppliers">Suppliers:</label>
                    <input type="text" id="suppliers" name="suppliers" required>

                    <label for="batch_no">Batch No:</label>
                    <input type="text" id="batch_no" name="batch_no" required>

                    <label for="expiration_date">Expiration Date:</label>
                    <input type="date" id="expiration_date" name="expiration_date" required>

                    <label for="manufacturing_date">Manufacturing Date:</label>
                    <input type="date" id="manufacturing_date" name="manufacturing_date" required>

                    <label for="stock_in">Stock In:</label>
                    <input type="number" id="stock_in" name="stock_in" required>

                    
                    <input type="submit" name="submit" value="Add Product">
                </form>
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

    
    <script>
        $(document).ready(function() {
            $("#addProductBtn").click(function() {
                $("#productModal").fadeIn();
            });

            $(".close").click(function() {
                $("#productModal").fadeOut();
            });

            $("#productForm").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "add_product_process.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response === "success") {
                            alert("Product added successfully!");
                            $("#productModal").fadeOut();
                            // Refresh the table data without reloading the page
                            refreshTableData();
                        } else {
                            alert("Failed to add product. Please try again.");
                        }
                    }
                });
            });
        });

        // Function to refresh the products table data without reloading the page
        function refreshTableData() {
            $(".table-responsive").load("products_table.php");
        }
    </script>

</body>
</html>
