<?php include('partials-front/menu.php') ?>


    <!-- Bắt đầu Food Search Section -->
    <section class="food-search text-center pos-relative">
        <video autoplay muted loop class="bgVideo">
            <source src="Video/BackgroundVideo.mp4" type="video/mp4">
        </video>
        <div class="container search-bar">
            <form action="<?php echo SITE_URL ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Bạn muốn ăn gì?" required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Kết thúc Food Search Section -->

    <?php
        if(isset($_SESSION['order'])){
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
    ?>


    <!-- Bắt đầu Categories Section -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
                // Truy vấn lấy dữ liệu từ DB
                $sql = "SELECT * FROM category WHERE active ='Yes' AND featured ='Yes' LIMIT 3";
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // Đếm dòng để kiểm tra có category nào không
                $count = mysqli_num_rows($res);

                if($count > 0){
                    // Caetgory available
                    while ($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITE_URL ?>category-foods.php?category_id=<?php echo $id ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    // Kiểm tra category có ảnh không
                                    if($image_name == ""){
                                        echo "<div class='error'>Image not available</div>";
                                    }else{
                                        ?>
                                        <img src="<?php echo SITE_URL ?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $title ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }else{
                    // category not avilable
                    echo "<div class='error'>Category not added</div>";
                }
            ?>



            
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Kết thúc Categories Section -->


    <!-- Bắt đầu Food Menu Section -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food menu</h2>

            <?php 
            // Truy vấn lấy dữ liệu từ DB
            $sql2 = "SELECT * FROM food WHERE featured = 'Yes' AND active ='Yes' LIMIT 10";
            // Thực hiện truy vấn
            $res2 = mysqli_query($conn, $sql2);
            // Đếm dòng để kiểm tra có food nào không
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0){
                // Food available
                while ($row = mysqli_fetch_assoc($res2)){
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    $price = $row['price'];
                    $description = $row['description'];
                    ?>
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <?php 
                                // Kiểm tra food có ảnh không
                                if($image_name == ""){
                                    echo "<div class='error'>Image not found</div>";
                                }else{
                                    ?>
                                    <img src="<?php echo SITE_URL ?>images/food/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve img-square">
                                    <?php
                                }
                            ?>                           
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title ?></h4>
                            <p class="food-price">$<?php echo $price ?></p>
                            <p class="food-detail">
                                <?php echo $description ?>
                            </p>
                            <br>

                            <a href="<?php echo SITE_URL ?>order.php?food_id=<?php echo $id ?>" class="btn btn-primary">Order now</a>
                        </div>
                    </div>
                    <?php
                }
            }else{
                // Food not available
                echo "<div class='error'>Food not found</div>";
            }
            ?>
         
            <div class="clearfix"></div>
        </div>
        <p class="text-center">
            <a href="<?php echo SITE_URL ?>foods.php">See all Foods</a>
        </p>
    </section>
    <!-- Kết thúc Food Menu Section -->

<?php include('partials-front/footer.php') ?>
