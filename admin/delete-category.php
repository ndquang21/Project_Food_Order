<?php include('../config/constant.php') ?>
<?php 
    // echo "Trang delete";
    // Kiểm tra id và image_name is set or not
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        // Get the value and delete

        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical file if available (nếu image_name không trống)
        if($image_name != ""){
            // Image available
            $path = "../images/category/".$image_name;
            // Remove image
            $remove = unlink($path);

            // Nếu xóa không thành công, hiện thông báo
            if($remove == false){
                // Thông báo và chuyển hướng
                $_SESSION['remove'] = "<div class='error'>Failed to remove Category image</div>";
                header('location:'.SITE_URL.'admin/manage-category.php');
                //Stop the process
                die();
            }
        }
        // Delete data from database
        //Truy vấn
        $sql = "DELETE FROM category WHERE id='$id'";

        // Thực thi truy vấn
        $res = mysqli_query($conn, $sql);

        //Kiểm tra data có được xóa thành công ko
        if($res == TRUE){
            // Thành công
            $_SESSION['delete'] = "<div class='success'>Deleted Scuccessfully</div>";
            header('location:'.SITE_URL.'admin/manage-category.php');
        }else{
            // Thất bại
            $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
            header('location:'.SITE_URL.'admin/manage-category.php');
        }

    }else{
        //Chuyển hướng về manage-category
        header('location:'.SITE_URL.'admin/manage-category.php');
    }
?>