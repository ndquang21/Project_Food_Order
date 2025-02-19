<?php include('../config/constant.php') ?>

<?php 

    // Lấy ID của staff sẽ bị xóa
    $id = $_GET['id'];
    // Truy vấn để xóa thông tin
    $sql = "DELETE FROM staff WHERE id = $id";

    // Thực thi truy vấn
    $res = mysqli_query($conn, $sql);

    //Kiểm tra xem truy vấn thành công ko?
    if ($res == TRUE){
        // Thành công và đã xóa staff
        // echo "xóa thành công";

        // Tạo biến session để hiển thi thông báo
        $_SESSION['delete'] = "<div class='success'>Xóa staff thành công</div>";
        // Chuyển hướng sang trang manage
        header('location: '.SITE_URL.'admin/manage-staff.php');
    }else{
        // Thất bại
        $_SESSION['delete'] = "<div class='error'>Xóa staff thất bại</div>";
        header('location: '.SITE_URL.'admin/manage-staff.php');
    }

    // 3. 

?>