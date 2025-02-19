<?php  include('../config/constant.php'); ?>

<?php 
    // destroy session rồi chuyển hướng về trang login
    session_destroy();  //unset $_SESSION['user']

    header('location: '.SITE_URL. 'admin/login.php');
?>