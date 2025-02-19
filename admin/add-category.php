<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br><br>

        <!-- Bắt đầu Add category form -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Kết thúc Add category form -->

        <?php 
            //Kiểm tra nút submit có được ấn
            if(isset($_POST['submit'])){
                // Lấy dữ liệu
                $title = mysqli_real_escape_string($conn, $_POST['title']);

                // Với radio type, kiểm tra xem đã được chọn chưa
                if(isset($_POST['featured'])){
                    // lấy dữ liệu
                    $featured = $_POST['featured'];
                }else{
                    // set default value 
                    $featured = "No";
                }

                if(isset($_POST['active'])){
                    // lấy dữ liệu
                    $active = $_POST['active'];
                }else{
                    // set default value 
                    $active = "No";
                }

                // Kiểm tra ảnh đã được chọn chưa
                // print_r($_FILES['image']);
                // die(); //break code here
                

                if(isset($_FILES['image']['name'])){
                    // Upload ảnh
                    // Để upload ảnh cần image name, source path và destination path
                    $image_name = $_FILES['image']['name'];
                    // Chỉ upload ảnh nếu ảnh được chọn
                    if($image_name != ""){
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
                            header('location:'.SITE_URL.'admin/add-category.php');
                            // Stop process
                            die();
                        }
                    }
                    
                }else{
                    // Ko upload ảnh và set value image_name là blank
                    $image_name="";
                }

                // Tạo truy vấn
                $sql = "INSERT INTO category 
                SET title = '$title', image_name = '$image_name', featured ='$featured', active = '$active'
                ";

                //Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);

                // Kiểm tra truy vấn có thực hiện thành công
                if ($res = TRUE){
                    //Thành công
                    $_SESSION['add'] = "<div class='success'>Category Add successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-category.php');
                }else{
                    //Thất bại
                    $_SESSION['add'] = "<div class='error'>Failed to Add category</div>";
                    header('location:'.SITE_URL.'admin/add-category.php');
                }
            }
        ?>

    </div>
</div>

<?php 

?>

<?php include('partials/footer.php') ?>