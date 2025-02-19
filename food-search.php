<?php include('partials-front/menu.php') ?>


    <!-- Bắt đầu Food Search Section -->
    <section class="food-search text-center pos-relative">
        <video autoplay muted loop class="bgVideo">
            <source src="Video/BackgroundVideo.mp4" type="video/mp4">
        </video>
        <div class="container search-bar width-auto">
            
            <?php 
                $search = mysqli_real_escape_string($conn, $_POST['search']);  // tránh SQLInjection
            ?>

            <h2 class="blur-bg text-white curve-box width-auto">Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- Kết thúc Food Search Section -->


    <!-- Bắt đầu Food Menu Section -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
                // Lấy thông tin search
                $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";
                
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                
                // Kiểm tra có food không?
                $count = mysqli_num_rows($res);
                if ($count >  0){
                    while ($row = mysqli_fetch_assoc($res)){
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
    
                                <a href="order.php" class="btn btn-primary">Order now</a>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo "<div class='error'>Food not found</div>";
                }
            ?>
            <div class="clearfix"></div>  

        </div>

    </section>
    <!-- Kết thúc Food Menu Section -->

    <?php include('partials-front/footer.php') ?>
