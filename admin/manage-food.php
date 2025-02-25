<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>

        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['unauthorize'])){
                echo $_SESSION['unauthorize'];
                unset($_SESSION['unauthorize']);
            }

            if(isset($_SESSION['remove-failed'])){
                echo $_SESSION['remove-failed'];
                unset($_SESSION['remove-failed']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>
        <br><br>
        <!-- Nút Add Food -->
        <a href="<?php echo SITE_URL ?>admin/add-food.php" class="btn-primary">Add Food</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th style="padding: 0%">S.N</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Action</th>
            </tr>

            <?php 
                // Tạo truy vấn để lấy thông tin Food
                $sql = " SELECT * FROM food";
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // Kiểm tra xem có data trong bảng k?
                $count = mysqli_num_rows($res);
                $sn = 1;  // S.N
                if($count > 0){
                    // Có => Lấy dữ liệu 
                    while ($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>
                        <tr>
                            <td><?php echo $sn++ ?> </td>
                            <td><?php echo $title ?></td>
                            <td><?php echo $price ?></td>
                            <td>
                                <?php 
                                    // Kiểm tra xem có ảnh ko thì mới hiện
                                    if($image_name ==""){
                                        // Ko có
                                        echo "<div class='error'>Image not added</div>";
                                    }else{
                                        // Có
                                        ?>
                                        <img src="<?php echo SITE_URL ?>images/food/<?php echo $image_name?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>
                            <td><?php echo $featured ?></td>
                            <td><?php echo $active ?></td>
                            <td>
                                <a href="<?php echo SITE_URL ?>/admin/update-food.php?id=<?php echo $id ?>" class="btn-secondary">Update</a>
                                <a href="<?php echo SITE_URL ?>/admin/delete-food.php?id=<?php echo $id ?>&image_name=<?php echo $image_name ?>" class="btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php
                    }
                }else{
                    // Food not added
                    echo "<tr><td colspan = '7' class='error'>No food to display</td></tr>";
                }
            ?>            
        </table>
    </div>    
</div>

<?php include('partials/footer.php'); ?>