<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Food</h1>
        <br><br>
        
        <?php
            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="50" rows="5" placeholder="Description of the food"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" step="0.01"> $
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">
                        <?php
                            // Code PHP để hiển thị các lựa chọn từ bẳng category từ DB
                            // Truy vấn để lấy active categories (active là "có phục vụ")
                            $sql = "SELECT * FROM category WHERE active='Yes'";

                            // Thực hiện truy vấn
                            $res = mysqli_query($conn, $sql);

                            // Kiểm tra có category nào không
                            $count = mysqli_num_rows($res);                         
                            if($count > 0){
                                // Có category
                                while($row = mysqli_fetch_assoc($res)){
                                    // Lấy dữ lệu
                                    $id = $row['id'];
                                    $title = $row['title'];
                        ?>
                                    <option value="<?php echo $id ?>"><?php echo $title ?></option>
                        <?php            
                                }
                            }else{
                                //Không có category
                        ?>
                                <option value="0">No category found</option>
                        <?php        
                            }
                        ?>
                        </select> (Only actived categories appear)
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            // Lấy thông tin và update DB
            if(isset($_POST['submit'])){
                $title = mysqli_real_escape_string($conn, $_POST['title']);
                $description = mysqli_real_escape_string($conn, $_POST['description']);
                $price = $_POST['price'];
                $category_id = $_POST['category'];
                // Với radio, kiểm tra xem đã chọn chưa?
                if(isset($_POST['featured'])){
                    $featured = $_POST['featured'];
                }else{
                    $featured = "No"; //default value
                }
                if(isset($_POST['active'])){
                    $active = $_POST['active'];
                }else{
                    $active = "No"; //default value
                }

                // Upload ảnh nếu có
                if(isset($_FILES['image']['name'])){
                    // Để upload ảnh cần image name, source path và destination path
                    $image_name = $_FILES['image']['name'];
                    // Chỉ upload ảnh nếu ảnh được chọn
                    if($image_name != ""){
                        // Auto rename image
                        // Get extension of image (jpg, png, gif, etc) e.g "foof.jpg"
                        $ext = end(explode('.', $image_name));
                        // Rename image
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext; //e.g. Food_Category_834.jpg
                        $source_path = $_FILES['image']['tmp_name']; 
                        $destination_path = "../images/food/".$image_name;

                        //Up ảnh
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        // Kiểm tra ảnh đã được upload chưa
                        // Nếu ảnh chưa được up thì chuyển hướng và thông báo
                        if($upload == false){
                            // Set thông báo
                            $_SESSION['upload'] = "<div class='error'>Upload ảnh thất bại</div>";
                            header('location:'.SITE_URL.'admin/add-food.php');
                            // Stop process
                            die();
                        }
                    }
                    
                }else{
                    $image_name="";      // Ko upload ảnh và set value image_name là blank

                }

                // Insert in DB
                // Truy vấn
                $sql2 = "INSERT INTO food SET
                title = '$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category_id,
                featured = '$featured',
                active = '$active'
                ";
                // Thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);
                // Kiểm tra truy vấn có thành công
                if($res2 == TRUE){
                    // Thành công
                    $_SESSION['add'] = "<div class='success'>Food added successfully.</div>";
                    header('location:'.SITE_URL.'admin/manage-food.php');
                }else{
                    // Thất bại
                    $_SESSION['add'] = "<div class='error'>Failed to add food.</div>";
                    header('location:'.SITE_URL.'admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>