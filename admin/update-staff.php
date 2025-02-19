<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Staff</h1>
        
        <br><br>

        <?php  
            // Lấy ID của staff cần sửa
            $id = $_GET['id'];
            // Truy vấn để lấy dữ liệu
            $sql = "SELECT * FROM staff WHERE id = $id";
            // Thực hiện truy vấn
            $res = mysqli_query($conn, $sql);
            //Kiểm tra truy vấn có thành công không?
            if ($res == TRUE){
                //Kiểm tra có dữ liệu không?
                $count = mysqli_num_rows($res);
                if($count == 1){
                    // Nếu có
                    // echo "Staff Available";
                    $row = mysqli_fetch_assoc($res);

                    $fullname = $row['fullname'];
                    $phone_number = $row['phone_number'];
                    $age = $row['age'];
                    $birthday = $row['birthday'];
                    $hire_date = $row['hire_date'];
                    $years_of_service = $row['years_of_service'];
                    $wage = $row['wage'];                
                }else{
                    //Nếu không
                    header('location:'.SITE_URL.'admin/manage-staff.php');
                }
            }
        ?>

        <form action="#" method="POST">
            <table class="tbl-30">
            <tr>
                <td>Full name: </td>
                    <td>
                        <input type="text" name="fullname" value="<?php echo $fullname ?>" require>
                    </td>
                </tr>

                <tr>
                    <td>Phone number: </td>
                    <td>
                        <input type="tel" name="phone_number" value="<?php echo $phone_number ?>">
                    </td>
                </tr>

                <tr>
                    <td>Birthday: </td>
                    <td>
                        <input type="date" name="birthday" value="<?php echo $birthday ?>" require>
                    </td>
                </tr>

                <tr>
                    <td>Hire date: </td>
                    <td>
                    <input type="date" name="hire_date" value="<?php echo $hire_date ?>" require>
                    </td>
                </tr>

                <tr>
                    <td>Wage: </td>
                    <td>
                        <input type="number" name="wage" value="<?php echo $wage ?>" require> $
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Update Staff" class="btn-secondary">
                    </td>
                </tr>
            </table>


        </form>
    </div>

</div>

<?php

    // Xử lý thông tin từ form và làm việc với Database
    // Kiểm tra xem nút submit được bấm chưa
    if(isset($_POST['submit'])){          // Nếu đã được ấn thì        
        //Lấy dữ liệu từ form
        $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
        $birthday = $_POST['birthday'];
        $hire_date = $_POST['hire_date']; 
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $wage = $_POST['wage'];


        // Tính tuổi
        $birth = new DateTime($birthday); // Ngày sinh
        $current_date = new DateTime(); // Hiện tại
        // Tính khoảng cách thời gian
        $interval = $birth->diff($current_date);
        $age = $interval->y; // tuổi

        
        // Tính thời gian làm viêc
        $start_date = new DateTime($hire_date); // Ngày bđ làm việc
        $current_date = new DateTime(); // Hiện tại
        // Tính khoảng cách thời gian
        $interval = $start_date->diff($current_date);
        $years_work = $interval->y; // số năm làm việc
        $months_work = $interval->m; // số tháng làm việc
        $years_of_service = number_format($years_work + ($months_work/ 12), 1); // năm làm việc (thập phân)
        if($years_of_service <= 0){
            $years_of_service = 0;
        }

        //SQLQuery lưu data
        $sql2 = "UPDATE staff SET
        fullname = '$fullname',
        phone_number = '$phone_number',
        age = $age,
        birthday = '$birthday',
        hire_date = '$hire_date',
        years_of_service = $years_of_service,
        wage = $wage
        WHERE id = $id
        ";

        // Thực thi truy vấn và lưu dữ liệu và DB
        $res2 = mysqli_query($conn, $sql2) or die (mysqli_error($conn));

        // Kiểm tra xem dữ liệu đã được lưu (Truy vấn thực hiện đúng) và hiện thông báo
        if($res2 == TRUE){
            //Data updated
            // Tạo biến session để hiển thi thông báo
            $_SESSION['update'] = "<div class='success'>Update staff thành công</div>";

            //Redirect page to Manage Admin
            header("location:".SITE_URL.'admin/manage-staff.php');   // = "location: http://localhost/Project_Food_Order/admin/manage-staff.php"
        } else {
            // Failed to update data
            // Tạo biến session để hiển thi thông báo
            $_SESSION['update'] = "<div class='success'>Update staff thất bại</div>";

            //Redirect page to Manage Admin
            header("location:".SITE_URL.'admin/add-staff.php');
        }

    }

    

?>


<?php include('partials/footer.php') ?>