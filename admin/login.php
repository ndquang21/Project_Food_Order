<?php include('../config/constant.php') ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="icon" href="../images/tab_logo.png" type="image/png"/>
    </head>

    <body>
        <video autoplay muted loop class="login-bgVideo">
            <source src="../Video/Login_bg_vid.mp4" type="video/mp4">
        </video>

        <div class="login">
            <h1 class="text-center">Login</h1>
            
            <br>
            <?php 
                if (isset($_SESSION['login'])){
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message'])){
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br>

            <!-- Bắt đầu Login form -->
             <form action="" method="POST" class="text-center">
                Username: <br>
                <input class="input-responsive" type="text" name="username" placeholder="Enter username"> <br><br>
                Password: <br>
                <input class="input-responsive" type="password" name="password" placeholder="Enter password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary">
                <br><br>
             </form>
            <!-- Kết thúc Login form -->

            <p class="text-center">Create By - <a href="#">quangn21</a></p>
        </div>
    </body>
</html>



<?php 

    // Kiểm tra nút submit có được ấn
    if(isset($_POST['submit'])){
        //Lấy thông tin đăng nhập
        $username = mysqli_real_escape_string($conn, $_POST['username']);         // tránh SQLInjection
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));    // tránh SQLInjection

        //Kiểm tra thông tin đăng nhập
        $sql = "SELECT * FROM admin
        WHERE username = '$username' AND password = '$password'
        ";

        //Thực hiện truy vấn
        $res = mysqli_query($conn, $sql);

        //Đếm số dòng xem user có tồn tại
        $count = mysqli_num_rows($res);
        if($count == 1){
            // Có tồn tại và đăng nhập thành công
            $_SESSION['login'] = "<div class='success'>Login successful</div>"; // Kiểm tra user có đăng nhập ko, unset khi logout
            $_SESSION['user'] = $username;
            header('location: '.SITE_URL.'admin/');
        }else{
            // Không tồn tại và đăng nhập ko thành công
            $_SESSION['login'] = "<div class='error text-center'>Wrong Username or Password</div>";
            header('location: '.SITE_URL.'admin/login.php');
        }

    }

?>