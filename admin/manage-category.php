<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found'])){
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove'])){
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }


        ?>
        <br><br>
        <!-- Nút Add Category -->
        <a href="<?php echo SITE_URL?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php
                // Truy vấn
                $sql = "SELECT * FROM category";

                // Thực thi truy vấn
                $res = mysqli_query($conn, $sql);

                // Đếm dòng
                $count = mysqli_num_rows($res);

                // Tạo S.N auto increase
                $sn = 1;

                //Kiểm tra xem có data trong DB không
                if ($count > 0){
                    // Hiển thị data
                    while($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $actve = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++ ?> </td>
                            <td><?php echo $title ?></td>

                            <td>
                                <?php 
                                    // Kiểm tra image_name available
                                    if($image_name != ""){
                                        // Hiển thị ảnh trong bảng
                                        ?>
                                            <img src="<?php echo SITE_URL; ?>images/category/<?php echo $image_name ?>" width="100px">
                                        <?php
                                    }else{
                                        // Hiển thị thông báo ko có ảnh
                                        echo "<div class='error'>Image not added</div>";
                                    }
                                ?>
                            </td>

                            <td><?php echo $featured ?></td>
                            <td><?php echo $actve ?></td>
                            <td>
                                <a href="<?php echo SITE_URL ?>admin/update-category.php?id=<?php echo $id ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITE_URL ?>admin/delete-category.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    // Không có data
                    // Hiển thị thông báo trong bảng     Ngắt php để viết html
                    ?> 

                    <tr> 
                        <td colspan="6"><div class="error">No Category Added.</div></td>
                    </tr>

                    <?php

                }



            ?>


        </table>
    </div>    
</div>

<?php include('partials/footer.php'); ?>