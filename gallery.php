
<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
  ?>
<!doctype html>
<html lang="en">
  <head>
    

    <title>Beauty Parlour Management System | gallery Page </title>

    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        body {
    font-family: Arial, sans-serif;
}

h1 {
    text-align: center;
}

.gallery {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-evenly;
    max-width: 1000px; /* Adjust the max-width to make the gallery wider */
    margin: 0 auto;
}

.gallery-item {
    margin: 20px; /* Increase the margin for more spacing between images */
    cursor: pointer;
}

.gallery-item img {
    width: 350px; /* Increase the image width */
    height: 350px; /* Increase the image height */
    object-fit: cover;
    border: 2px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

.gallery-item img:hover {
    border-color: #555;
}

.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.8);
}

.modal-img {
    display: block;
    max-width: 90%;
    max-height: 90%;
    margin: 60px auto;
}

.close {
    color: white;
    font-size: 30px;
    position: absolute;
    top: 15px;
    right: 30px;
    cursor: pointer;
}

    </style>
  </head>
  <body id="home">
<?php include_once('includes/header.php');?>

<script src="assets/js/jquery-3.3.1.min.js"></script> <!-- Common jquery plugin -->
<!--bootstrap working-->
<script src="assets/js/bootstrap.min.js"></script>
<!-- //bootstrap working-->
<!-- disable body scroll which navbar is in active -->
<script>
$(function () {
  $('.navbar-toggler').click(function () {
    $('body').toggleClass('noscroll');
  })
});
</script>
<!-- disable body scroll which navbar is in active -->

<!-- breadcrumbs -->
<section class="w3l-inner-banner-main">
    <div class="about-inner services ">
        <div class="container">   
            <div class="main-titles-head text-center">
            <h3 class="header-name ">
                Gallery
            </h3>
        </div>
</div>
</div>
<div class="breadcrumbs-sub">
<div class="container">   
<ul class="breadcrumbs-custom-path">
    <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
    <li class="active ">Gallery</li>
</ul>
</div>
</div>
    </div>
</section>
<!-- breadcrumbs //-->
<div class="gallery">
        <!-- First row -->
        <div class="gallery-row">
            <div class="gallery-item">
                <img src="assets/images/g1.jpg" alt="Image 1">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g2.jpg" alt="Image 2">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g3.jpg" alt="Image 3">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g4.jpg" alt="Image 4">
            </div>
        </div>
        <!-- Second row -->
        <div class="gallery-row">
            <div class="gallery-item">
                <img src="assets/images/g5.jpg" alt="Image 5">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g6.jpg" alt="Image 6">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g7.jpg" alt="Image 7">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g8.jpg" alt="Image 8">
            </div>
        </div>
        <!-- Third row -->
        <div class="gallery-row">
            <div class="gallery-item">
                <img src="assets/images/g9.jpg" alt="Image 9">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g10.jpg" alt="Image 10">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g11.jpg" alt="Image 11">
            </div>
            <div class="gallery-item">
                <img src="assets/images/g12.jpg" alt="Image 12">
            </div>
        </div>
    </div>    

    <div class="modal" id="modal">
        <span class="close" id="close">&times;</span>
        <img src="" alt="" id="modal-img">
    </div>

    <script>
        // Get all gallery items
        const galleryItems = document.querySelectorAll('.gallery-item img');

        // Get the modal and modal image elements
        const modal = document.getElementById('modal');
        const modalImg = document.getElementById('modal-img');

        // Attach click event listeners to each gallery item
        galleryItems.forEach(item => {
            item.addEventListener('click', () => {
                modalImg.src = item.src;
                modal.style.display = 'block';
            });
        });

        // Close the modal when the close button is clicked
        const closeModal = () => {
            modal.style.display = 'none';
        };

        document.getElementById('close').addEventListener('click', closeModal);

        // Close the modal when clicking outside the image
        window.addEventListener('click', (event) => {
            if (event.target === modal) {
                closeModal();
            }
        });
    </script>
</body>
</html>








<?php include_once('includes/footer.php');?>
<!-- move top -->
<button onclick="topFunction()" id="movetop" title="Go to top">
	<span class="fa fa-long-arrow-up"></span>
</button>
<script>
	// When the user scrolls down 20px from the top of the document, show the button
	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			document.getElementById("movetop").style.display = "block";
		} else {
			document.getElementById("movetop").style.display = "none";
		}
	}

	// When the user clicks on the button, scroll to the top of the document
	function topFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>
<!-- /move top -->
</body>

</html>

