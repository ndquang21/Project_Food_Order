<?php include('../config/constant.php')?>

<?php 
    if(isset($_GET['id']) && isset($_GET['image_name'])){
        //Lấy thông tin
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        // Kiểm tra xem có ảnh ko? Xóa nếu có
        if($image_name != ""){
            $path = "../images/food/".$image_name;
            $remove = unlink($path);

            // Kiểm tra xem ảnh có được xóa thành công
            if($remove == false){
                $_SESSION['upload'] = "<div class='error'>Failed to remove image file.</div>";
                header('locatin:'.SITE_URL.'admin/manage-food.php');
                die();
            }
        }
        // Xóa thông tin trong DB
        // Truy vấn
        $sql = "DELETE FROM food WHERE id = $id";
        // Thực hiện truy vấn
        $res = mysqli_query($conn, $sql);
        // Kiểm tra truy vấn
        if($res == TRUE){
            $_SESSION['delete'] = "<div class = 'success'>Food deleted successfully</div>";
            header('location:'.SITE_URL.'admin/manage-food.php');
        }else{
            $_SESSION['delete'] = "<div class = 'error'>Failed to delete food</div>";
            header('location:'.SITE_URL.'admin/manage-food.php');
        }
    }else{
        // Chuyển hướng về trang manage // xảy ra nếu người dùng không truyền id và image_name mà chỉ vào delete.php
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access</div>";
        header('location:'.SITE_URL.'admin/manage-food.php');
    }

?>