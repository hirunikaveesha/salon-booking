<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Beauty Parlour Management System | Testimonial</title>
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style-starter.css">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Slab:400,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <style>
        body, h1, form {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        /* ... Rest of your existing CSS styles ... */

        /* New styles for the "Add Testimonial" button */
        .add-testimonial-btn {
            display: block;
            margin: 20px auto;
            padding: 15px 40px;
            background-color:#3EA39D ;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }

        /* New styles for the testimonial form popup */
        #testimonialForm {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999;
            max-width: 90%;
            width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            display: none;
        }

        /* Additional styles to make the form look beautiful */
        #testimonialForm label {
            color: #333;
        }

        #testimonialForm input[type="text"],
        #testimonialForm input[type="email"],
        #testimonialForm textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        #testimonialForm textarea {
            resize: vertical;
        }

        #testimonialForm input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
        }

        #testimonialForm input[type="submit"]:hover {
            background-color: #45a049;
        }

        #testimonials {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

#testimonials div {
  margin-bottom: 15px;
  border-bottom: 1px solid #ccc;
  padding-bottom: 10px;
}

#testimonials strong {
  font-weight: bold;
}

        /* Media Query for Responsiveness */
        @media (max-width: 768px) {
            #testimonialForm {
                width: 90%;
            }
        }
    </style>
</head>

<body id="home">
    <?php include_once('includes/header.php'); ?>
    
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
    <!-- Breadcrumbs -->
    <section class="w3l-inner-banner-main">
    <div class="about-inner about ">
            <div class="container">   
                <div class="main-titles-head text-center">
                    <h3 class="header-name ">
					    Testimonials
                    </h3>
                </div>
            </div>
        </div>
   <div class="breadcrumbs-sub">
   <div class="container">   
    <ul class="breadcrumbs-custom-path">
        <li class="right-side propClone"><a href="index.php" class="">Home <span class="fa fa-angle-right" aria-hidden="true"></span></a> <p></li>
        <li class="active ">Testimonials</li>
    </ul>
    </div>
    </div>
        </div>
    </section>

    <button class="add-testimonial-btn" id="addTestimonialBtn">Add Testimonial</button>
    <div id="testimonialForm">
        <form id="testimonialSubmitForm" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="message">Message:</label>
            <textarea id="message" name="message" rows="4" required></textarea>
            <br>
            <input type="submit" value="Submit">
        </form>
    </div>
    <div id="testimonials">
        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];
            $testimonialData = "Name: $name\nEmail: $email\nMessage: $message\n\n";
            file_put_contents("testimonials.txt", $testimonialData, FILE_APPEND);
            echo "<p>Testimonial submitted successfully!</p>";
        }
        ?>
        <!-- Testimonials will be dynamically added here -->
        <?php
        $testimonials = file_get_contents("testimonials.txt");
        $testimonialsArray = explode("\n\n", $testimonials);
        foreach ($testimonialsArray as $testimonial) {
            echo "<div>$testimonial<hr></div>";
        }
        ?>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
    const addTestimonialBtn = document.getElementById("addTestimonialBtn");
    const testimonialForm = document.getElementById("testimonialForm");
    const testimonialSubmitForm = document.getElementById("testimonialSubmitForm");
    const testimonialsContainer = document.getElementById("testimonials");

    addTestimonialBtn.addEventListener("click", function() {
        testimonialForm.style.display = "block";
    });

    testimonialSubmitForm.addEventListener("submit", function(event) {
        event.preventDefault();

        const name = document.getElementById("name").value;
        const email = document.getElementById("email").value;
        const message = document.getElementById("message").value;

        // Perform validation if needed (e.g., valid email)

        // Here you can send the testimonial data to your server using AJAX
        // For simplicity, let's assume the testimonial is successfully saved on the server

        // Once the testimonial is successfully saved, you can create a new testimonial element and add it to the testimonials container
        const newTestimonial = document.createElement("div");
        newTestimonial.innerHTML = `<strong>${name}</strong> (${email}):<br>${message}<hr>`;
        testimonialsContainer.appendChild(newTestimonial);

        testimonialForm.style.display = "none";
        testimonialSubmitForm.reset();
    });
});

    </script>
    <?php include_once('includes/footer.php'); ?>

    <!-- move top button and scroll function -->
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

        // Testimonial form popup functionality
        document.addEventListener("DOMContentLoaded", function () {
            const addTestimonialBtn = document.getElementById("addTestimonialBtn");
            const testimonialForm = document.getElementById("testimonialForm");
            const testimonialSubmitForm = document.getElementById("testimonialSubmitForm");
            const testimonialsContainer = document.getElementById("testimonials");

            addTestimonialBtn.addEventListener("click", function () {
                testimonialForm.style.display = "block";
            });

            testimonialSubmitForm.addEventListener("submit", function (event) {
                event.preventDefault();

                const name = document.getElementById("name").value;
                const email = document.getElementById("email").value;
                const message = document.getElementById("message").value;

                // Perform validation if needed (e.g., valid email)

                // Here you can send the testimonial data to your server using AJAX
                // For simplicity, let's assume the testimonial is successfully saved on the server

                // Once the testimonial is successfully saved, you can create a new testimonial element and add it to the testimonials container
                const newTestimonial = document.createElement("div");
                newTestimonial.innerHTML = `<strong>${name}</strong> (${email}):<br>${message}<hr>`;
                testimonialsContainer.appendChild(newTestimonial);

                testimonialForm.style.display = "none";
                testimonialSubmitForm.reset();
            });
        });
    </script>
</body>

</html>
