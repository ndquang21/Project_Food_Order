<?php include('config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Cần thiết để cho website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodi</title>

    <!-- CSS file -->
    <link rel="stylesheet" href="css/style.css">     
    <link rel="icon" href="images/tab_logo.png" type="image/png"/>

</head>

<body>
    <!-- Bắt đầu Navbar Section -->
    <section class="navbar">
        <div class="container">
            <div>
                <a href="<?php echo SITE_URL ?>" class="logo-a">
                    <img src="images/logo.png" alt="Restaurant Logo" class="logo">
                </a>
            </div>

            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="<?php echo SITE_URL ?>index.php">Home</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL ?>categories.php">Categories</a>
                    </li>
                    <li>
                        <a href="<?php echo SITE_URL ?>foods.php">Foods</a>
                    </li>                    
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Kết thúc Navbar Section -->

    