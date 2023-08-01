<?php 
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['bpmsuid']==0)) {
  header('location:logout.php');
  } else{
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Prepare and execute the SQL query to insert the testimonial into the database
    $stmt = $conn->prepare("INSERT INTO testimonials (name, email, message, date) VALUES (?, ?, ?, NOW())");
    $stmt->bind_param("sss", $name, $email, $message);
    $stmt->execute();
    
    // Close the database connection
    $conn->close();
    
    // Respond with a success message
    echo "Testimonial submitted successfully!";
  }



  ?>