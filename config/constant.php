<?php 
    ob_start();
    // Start Session
    session_start();

    // Create constant to store non repeating values
    define('SITE_URL', 'http://localhost/Project_Food_Order/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food_order');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die (mysqli_connect_error()); // Kết nối database
    $db_select = mysqli_select_db($conn, DB_NAME) or die (mysqli_error($conn)); //Chọn database
?>