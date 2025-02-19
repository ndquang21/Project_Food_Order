<?php include('partials-front/menu.php') ?>

<?php 
    // Kiểm tra id được pas chưa
    if(isset($_GET['category_id'])){
        // category_id đã được set
        $category_id = $_GET['category_id'];
        // Lấy category title
        $sql = "SELECT title FROM category WHERE id = '$category_id'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
    }else{
        // category_id chưa được set
        header('location:'.SITE_URL);
    }
?>

    <!-- Bắt đầu Food Search Section -->
    <section class="food-search text-center pos-relative">
        <video autoplay muted loop class="bgVideo">
            <source src="Video/BackgroundVideo.mp4" type="video/mp4">
        </video>
        <div class="container search-bar width-auto">

            <h2 class="blur-bg text-white curve-box width-auto">Foods on <a href="" class="text-white">"<?php echo $title ?>"</a></h2>

        </div>
    </section>
    <!-- Kết thúc Food Search Section -->
    



    <!-- Bắt đầu Food Menu Section -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            // Truy vấn lấy dữ liệu từ DB
            $sql2 = "SELECT * FROM food WHERE active ='Yes' AND category_id = '$category_id'";
            // Thực hiện truy vấn
            $res2 = mysqli_query($conn, $sql2);
            // Đếm dòng để kiểm tra có food nào không
            $count2 = mysqli_num_rows($res2);

            if($count2 > 0){
                // Food available
                while ($row2 = mysqli_fetch_assoc($res2)){
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $image_name = $row2['image_name'];
                    $price = $row2['price'];
                    $description = $row2['description'];
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

    </section>
    <!-- Kết thúc Food Menu Section -->

    <?php include('partials-front/footer.php') ?>
