<?php include('partials/menu.php') ?>
<?php 
    // Kiểm tra id is set or not
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // truy vấn
        $sql2 = "SELECT * FROM food WHERE id = $id";
        // thực hiện truy vấn
        $res2 = mysqli_query($conn, $sql2);

        // Lấy thông tin 
        $row = mysqli_fetch_assoc($res2);
        $title = $row['title'];
        $description = $row['description'];
        $price = $row['price'];
        $current_image = $row['image_name'];
        $current_category = $row['category_id'];
        $featured = $row['featured'];
        $active = $row['active'];

    }else{
        header('location:'.SITE_URL.'admin/manage-food.php');
    }
?>
<div class = "main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title ?>">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols = "30" rows = "5"><?php echo $description ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price ?>">
                    </td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php
                            if($current_image == ""){
                                echo "<div>Image not available</div>";
                            }else{
                                ?>
                                <img src="<?php echo SITE_URL ?>/images/food/<?php echo $current_image ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Select new Image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php
                                $sql = "SELECT * FROM category WHERE active = 'Yes'"; // Chỉ category active mới được thêm food
                                $res = mysqli_query($conn, $sql);
                                // đếm xem thông tin lấy ra có dòng nào không
                                $count = mysqli_num_rows($res);
                                if($count > 0){
                                    while ($row=mysqli_fetch_assoc($res)){
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];                                    
                                        ?>
                                        <option <?php if($current_category == $category_id){echo "selected";} ?> value="<?php echo $category_id ?>"><?php echo $category_title ?></option>                                  
                                        <?php
                                    }
                                }else{
                                    // category not available
                                    echo "<option value = '0''>Category not available</option>";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input <?php if($featured == "Yes") echo "checked"; ?> type="radio" name="featured" value="Yes"> Yes
                        <input <?php if($featured == "No") echo "checked"; ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input <?php if($active == "Yes") echo "checked"; ?> type="radio" name="active" value="Yes"> Yes
                        <input <?php if($active == "No") echo "checked"; ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])){
                // Lấy thông tin từ form trên
                $id = $_POST['id'];
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // Upload ảnh nếu có
                if(isset($_FILES['image']['name'])){
                    $image_name = $_FILES['image']['name'];

                    if ($image_name != ""){
                        // Auto rename image
                        // Get extension of image (jpg, png, gif, etc) e.g "foof.jpg"
                        $ext_part = explode('.', $image_name);
                        $ext = end($ext_part);
                        // Rename image
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext; //e.g. Food_Name_834.jpg
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/food/".$image_name;

                        //Up ảnh
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        // Kiểm tra ảnh đã được upload chưa
                        // Nếu ảnh chưa được up thì chuyển hướng và thông báo
                        if($upload == false){
                            // Set thông báo
                            $_SESSION['upload'] = "<div class='error'>Upload ảnh thất bại</div>";
                            header('location:'.SITE_URL.'admin/manage-food.php');
                            // Stop process
                            die();
                        }

                        // Xóa ảnh hiện tại (current_image) nếu có
                        if($current_image != ""){
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);
    
                            // Kiểm tra ảnh cũ đã được xóa hay chưa? nếu thất bại thì hiện thông báo và dừng process
                            if($remove == false){
                                // Thất bại
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current image</div>";
                                header('location:'.SITE_URL.'admin/manage-food.php');
                                die(); //stop process
                            }
                        }
                        
                    }else{
                        $image_name = $current_image;
                    }

                }else{
                    $image_name = $current_image;
                }

                // Update DB
                $sql3 = "UPDATE food SET 
                title = '$title',
                description = '$description', 
                price = $price,                 
                image_name = '$image_name', 
                category_id = '$category', 
                featured = '$featured',
                active = '$active'
                WHERE id = '$id'  
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3 == TRUE){
                    //Thành công
                    $_SESSION['update'] = "<div class='success'>Food update successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-food.php');
                }else{
                    //Thất bại
                    $_SESSION['update'] = "<div class='error'>Failed to update food</div>";
                    header('location:'.SITE_URL.'admin/manage-food.php');
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>
