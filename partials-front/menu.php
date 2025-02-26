<?php include('config/constant.php') ?>

<!DOCTYPE html>
<html lang="en">
<!-- Start EasyChatGPT -->
<script src="https://widget.easychatgpt.io/dist/widget/main.js"></script>
<script>window.EasyChatGPT.init({"handle":"quangn21site"})</script>
<!-- End EasyChatGPT -->

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
        <div class="container container-menu">
            <div class = "logo">
                <a href="<?php echo SITE_URL ?>" class="logo-a">
                    <img height="80px" src="images/logo.png" alt="Restaurant Logo" class="img-responsive">
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

    