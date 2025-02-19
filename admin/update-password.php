<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Passwword: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Passwword: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>

    </div>
</div>

<?php 

    //Kiểm tra bấm submit
    if (isset($_POST['submit'])){
        // Lấy dữ liệu
        $id = $_POST['id'];
        $current_password = mysqli_real_escape_string($conn, md5($_POST['current_password']));
        $new_password = mysqli_real_escape_string($conn, md5($_POST['new_password']));
        $confirm_password = mysqli_real_escape_string($conn, md5($_POST['confirm_password']));
        
        // Kiểm tra xem 'Current password' có tồn tại không
        $sql = "SELECT * FROM admin WHERE id = $id AND password = '$current_password'";

        $res = mysqli_query($conn, $sql);
        if($res == TRUE){
            $count = mysqli_num_rows($res);
            if($count == 1){
                //Nếu user tồn tại, thực hiện thay đổi
                //Kiểm tra mật khẩu mới và confirm có khớp
                if($new_password == $confirm_password){
                    // Update password
                    $sql2 = "UPDATE admin SET
                    password = '$new_password'
                    WHERE id = $id
                    ";
                    // Thực hiện truy vấn
                    $res2 = mysqli_query($conn, $sql2);

                    // Kiểm tra truy vấn có thành công không?
                    if ($res2 == TRUE){
                        // Thành công
                        $_SESSION['change-pwd'] = "<div class='success'>Đổi mật khẩu thành công</div>";
                        header('location: '.SITE_URL.'admin/manage-admin.php');
                    }else{
                        //Thất bại
                        $_SESSION['change-pwd'] = "<div class='error'>Đổi mật khẩu thất bại</div>";
                        header('location: '.SITE_URL.'admin/manage-admin.php');                        
                    }
                } else{
                    // Chuyển hướng và hiện thông báo 'mk không khớp'
                    $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu mới không khớp</div>";
                    header('location: '.SITE_URL.'admin/manage-admin.php');
                }
            }else{
                //Nếu user ko tồn tại
                $_SESSION['user-not-found'] = "<div class='error'>User không tồn tại / Sai mật khẩu</div>";
                //Chuyển hướng
                header('location: '.SITE_URL.'admin/manage-admin.php');
            }
        }

        // Đổi mật khẩu nếu đúng hết điều kiện trên
    }

?>

<?php include('partials/footer.php') ?>