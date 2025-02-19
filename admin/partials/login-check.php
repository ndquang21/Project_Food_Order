<?php 
    // Kiểm tra user login không? (Authorization - Access control)
    if(!isset($_SESSION['user'])){ // nếu chưa được set => chưa login
        $_SESSION['no-login-message'] = "<div class='error text-center'>Please login to access Admin Panel</div>";
        header('location:'.SITE_URL.'admin/login.php');
    }
?>