<?php include('partials-front/menu.php') ?>




      <!-- Bắt đầu Categories Section -->
      <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
                // Truy vấn lấy dữ liệu từ DB
                $sql = "SELECT * FROM category WHERE active ='Yes'";
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
                                        echo "<div class='error'>Image not found</div>";
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
                    echo "<div class='error'>Category not found</div>";
                }
            ?>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Kết thúc Categories Section -->

    <?php include('partials-front/footer.php') ?>
