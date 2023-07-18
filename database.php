<?php

// Database configuration 
$dbHost     = "localhost";  //  your hostname
$dbUsername = "root";       //  your table username
$dbPassword = "";          // your table password
$dbName     = "hmis";  // your database name
 
// Create database connection 
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 
if ($conn->connect_error) { 
    die("Connection failed: " . $conn->connect_error); 
} 

?>