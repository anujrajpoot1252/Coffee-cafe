<?php
// Simple registration script
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
$conn = mysqli_connect("localhost", "root", "", "customer");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get data from form
$username = $_POST['username'];
$email    = $_POST['email'];
$phone    = $_POST['phone'];
$address  = $_POST['address'];
$password = $_POST['password'];

// Basic checks
if (empty($username) || empty($email) || empty($password)) {
    echo "Please fill all required fields.";
    exit;
}

// Check if username already exists
$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "Username or Email already exists!";
    exit;
}

// Hash the password before saving
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Save data
$sql = "INSERT INTO users (username, email, password, address, phone) 
        VALUES ('$username', '$email', '$hashed', '$address', '$phone')";

if (mysqli_query($conn, $sql)) {
    echo "Registration successful! <a href='login.html'>Login now</a>";
} else {
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>

