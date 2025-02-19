
<?php include('partials/menu.php'); ?>


        <!-- Bắt đầu Main Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>Manage Staff</h1>
                
                <br>

                <?php
                    if(isset($_SESSION['add'])){
                        echo $_SESSION['add'];      // Hiển thị thông báo
                        unset($_SESSION['add']);    // Xóa thông báo
                    }

                    if(isset($_SESSION['delete'])){
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['update'])){
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['user-not-found'])){
                        echo $_SESSION['user-not-found'];
                        unset($_SESSION['user-not-found']);
                    }

                    if(isset($_SESSION['pwd-not-match'])){
                        echo $_SESSION['pwd-not-match'];
                        unset($_SESSION['pwd-not-match']);
                    }

                    if(isset($_SESSION['change-pwd'])){
                        echo $_SESSION['change-pwd'];
                        unset($_SESSION['change-pwd']);
                    }

                ?>
                <br><br><br>

                <!-- Nút Add Admin -->
                <a href="add-staff.php" class="btn-primary">Add Staff</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full name</th>
                        <th>Phone number</th>
                        <th>Age</th>
                        <th>Birthday</th>
                        <th>Hired date</th>
                        <th>Years of service</th>
                        <th>Wage</th>
                        <th>Action</th>

                    </tr>

                    <?php 
                        //Hiển thị danh sách admin
                        $sql = "SELECT * FROM staff";
                        //Thực thi truy vấn
                        $res = mysqli_query($conn, $sql);

                        // Kiểm tra truy vấn đúng chưa?
                        if($res == TRUE){
                            // Đếm dòng để kiểm tra có dữ liệu trong DB không?
                            $count = mysqli_num_rows($res); // Hàm lấy số dòng trong DB

                            $sn = 1; // Biến đếm S.N

                            if($count > 0){
                                // Có data
                                while($row=mysqli_fetch_assoc($res)){
                                    // Vòng lặp lấy data từ DB
                                    // Vòng lặp thực hiện đến khi hết data

                                    // Lấy data
                                    $id = $row['id'];
                                    $fullname = $row['fullname'];
                                    $phone_number = $row['phone_number'];
                                    if($phone_number == ""){
                                        $phone_number = "<div class='error'>No phone number</div>";
                                    }
                                    $age = $row['age'];
                                    $birthday = $row['birthday'];
                                    $hire_date = $row['hire_date'];
                                    $years_of_service = $row['years_of_service'];
                                    $wage = $row['wage'];

                                    ?>
                                    <!-- Hiển thị value trong bảng -->
                                    <tr>
                                        <td><?php echo $sn++ ?> </td>
                                        <td><?php echo $fullname ?></td>
                                        <td><?php echo $phone_number ?></td>
                                        <td><?php echo $age ?></td>
                                        <td><?php echo $birthday ?></td>
                                        <td><?php echo $hire_date ?></td>
                                        <td><?php echo $years_of_service ?> years</td>
                                        <td>$<?php echo $wage ?></td>

                                        <td>
                                            <a href="<?php echo SITE_URL; ?>admin/update-staff.php?id=<?php echo $id ?>" class="btn-secondary">Update Staff</a> <!-- gửi dữ liệu id đến update-staff bằng GET -->
                                            <a href="<?php echo SITE_URL;?>admin/delete-staff.php?id=<?php echo $id ?>" class="btn-danger">Delete Staff</a>   <!-- gửi dữ liệu id đến delete-staff bằng GET -->
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }else{
                                // Không có data
                            }
                        }
                    ?>
                </table>

                

            </div>
        </div>
        <!-- Kết thúc Main Content Section -->


<?php include('partials/footer.php'); ?>                