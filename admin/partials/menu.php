<!-- Kết nối DB -->
<?php include('../config/constant.php'); ?> 
<!-- Kiểm tra đăng nhập (Authorization Access) -->
<?php include('login-check.php'); ?>


<!-- Menu -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Foodi - Admin</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/tab_logo.png" type="image/png"/>
    </head>

    <body>
        <!-- Bắt đầu Menu Section -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="manage-staff.php">Staff</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food</a></li>
                    <li><a href="manage-order.php">Order</a></li>

                    <li><a class="btn-change-pwd" href="update-password.php">Change password</a></li>                    
                    <li><a class="btn-change-pwd" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Kết thúc Menu Section -->
