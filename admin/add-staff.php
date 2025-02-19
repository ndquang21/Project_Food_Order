<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Staff</h1>

        <br><br>
        <?php 
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];      // Hiển thị thông báo
                unset($_SESSION['add']);    // Xóa thông báo
            }
        ?>
        <br>

        <form action="#" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Full name: </td>
                    <td>
                        <input type="text" name="fullname" placeholder="Enter staff name" require>
                    </td>
                </tr>

                <tr>
                    <td>Phone number: </td>
                    <td>
                        <input type="tel" name="phone_number">
                    </td>
                </tr>

                <tr>
                    <td>Birthday: </td>
                    <td>
                        <input type="date" name="birthday" require>
                    </td>
                </tr>

                <tr>
                    <td>Hire date: </td>
                    <td>
                    <input type="date" name="hire_date" require>
                    </td>
                </tr>

                <tr>
                    <td>Wage: </td>
                    <td>
                        <input type="number" name="wage" require> $
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Staff" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php include('partials/footer.php') ?>


<?php 
    // Xử lý thông tin từ form và làm việc với Database
    
    // Kiểm tra xem nút submit được bấm chưa
    if(isset($_POST['submit'])){          // Nếu đã được ấn thì
        // echo "Đã ấn nút submit";
        
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
        $sql = "INSERT INTO staff SET
        fullname = '$fullname',
        phone_number = '$phone_number',
        age = $age,
        birthday = '$birthday',
        hire_date = '$hire_date',
        years_of_service = $years_of_service,
        wage = $wage
        ";

        // Thực thi truy vấn và lưu dữ liệu và DB
        $res = mysqli_query($conn, $sql) or die (mysqli_error($conn));

        // Kiểm tra xem dữ liệu đã được lưu (Truy vấn thực hiện đúng) và hiện thông báo
        if($res == TRUE){
            //Data inserted
            //echo "data inserted";

            // Tạo biến session để hiển thi thông báo
            $_SESSION['add'] = "<div class='success'>Thêm staff thành công</div>";

            //Redirect page to Manage Admin
            header("location:".SITE_URL.'admin/manage-staff.php');   // = "location: http://localhost/Project_Food_Order/admin/manage-staff.php"
        } else {
            // Failed to insert data
            //echo "data not inserted";

            // Tạo biến session để hiển thi thông báo
            $_SESSION['add'] = "<div class='success'>Thêm staff thất bại</div>";

            //Redirect page to Manage Admin
            header("location:".SITE_URL.'admin/add-staff.php');
        }

    }
?>

