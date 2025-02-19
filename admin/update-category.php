<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>
        <?php 
            //Kiểm tra id được set ko
            if(isset($_GET['id'])){
                // Lấy id và các thông tin khác
                $id = $_GET['id'];
                // Tạo truy vấn để lấy thông tin trong DB
                $sql = "SELECT * FROM category WHERE id = $id";
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);

                // Đếm dòng để xem id có valid
                $count = mysqli_num_rows($res);

                if($count == 1){
                    // Lấy data
                    $row = mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }else{
                    // Chuyển hướng về trang manage và thông báo
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }

            }else{
                // Chuyển hướng về trang manage
                header('location:'.SITE_URL.'admin/manage-category.php');
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image != ""){
                                // Display image
                        ?>   
                            <img src="<?php echo SITE_URL ?>images/category/<?php echo $current_image ?>" alt="" width ="150px" > 
                        <?php        
                            }else{
                                // Display message
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured == "Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes  
                        <input <?php if($featured == "No"){echo "checked";} ?> type="radio" name="featured" value="No"> No  
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active == "Yes"){echo "checked";}?> type="radio" name="active" value="Yes"> Yes  
                        <input <?php if($active == "No"){echo "checked";}?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php // Update thông tin vào DB

            // Kiểm tra xem đã ấn submit chưa
            if(isset($_POST['submit'])){
                //Lấy dữ liệu từ form
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Update New Image (nếu có)
                // Kiểm tra có thay ảnh mới không
                if(isset($_FILES['image']['name'])){
                    // Lấy dữ liệu
                    $image_name = $_FILES['image']['name'];

                    // Kiểm tra có ảnh được chọn không
                    if ($image_name != ""){
                        // Auto rename image
                        // Get extension of image (jpg, png, gif, etc) e.g "foof.jpg"
                        $ext = end(explode('.', $image_name));
                        // Rename image
                        $image_name = "Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_834.jpg
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;

                        //Up ảnh
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        // Kiểm tra ảnh đã được upload chưa
                        // Nếu ảnh chưa được up thì chuyển hướng và thông báo
                        if($upload == false){
                            // Set thông báo
                            $_SESSION['upload'] = "<div class='error'>Upload ảnh thất bại</div>";
                            header('location:'.SITE_URL.'admin/manage-category.php');
                            // Stop process
                            die();
                        }

                        // Xóa ảnh hiện tại (current_image) nếu có
                        if($current_image != ""){
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
    
                            // Kiểm tra ảnh cũ đã được xóa hay chưa? nếu thất bại thì hiện thoogn báo và dừng process
                            if($remove == false){
                                // Thất bại
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITE_URL.'admin/manage-category.php');
                                die(); //stop process
                            }
                        }
                        
                    }else{
                        $image_name = $current_image;
                    }
                }else{
                    $image_name = $current_image;
                }

                //Truy vấn
                $sql2 = "UPDATE category SET
                    title = '$title', 
                    image_name = '$image_name',
                    featured = '$featured', 
                    active = '$active'
                    WHERE id = $id;
                ";
                //Thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);
                
                // Kiểm tra truy vấn có thành công?
                if($res2 == TRUE){
                    //Thành công
                    $_SESSION['update'] = "<div class='success'>Category update successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }else{
                    //Thất bại
                    $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>