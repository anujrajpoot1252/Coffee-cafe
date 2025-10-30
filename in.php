<?php
$servername = "127.0.0.1";
$username = "coffee";
$password = "coffee123";
$dbname = "my";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully :)";
// data recevie ke liye
$user = $_POST['username'];
$pass = $_POST['password'];

// data base ke liye
$sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0) {
    echo "Login successful!";
} else {
    echo "Invalid username or password!";
}

?>