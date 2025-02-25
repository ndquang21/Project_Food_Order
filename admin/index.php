
<?php include('partials/menu.php'); ?>

        <!-- Bắt đầu Main Content Section -->
        <div class="main-content">
            <div class="wrapper">
                <h1>DASHBOARD</h1>

                <br><br>
                <?php 
                    if (isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']);
                    }
                ?>
                <br>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql6 = "SELECT * FROM staff";
                        // Thực hiện truy vấn
                        $res6 = mysqli_query($conn, $sql6);
                        // Đếm dòng
                        $count6 = mysqli_num_rows($res6);

                    ?>
                    <h1><?php echo $count6 ?></h1>
                    <br>
                    Staffs
                </div>
                
                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql = "SELECT * FROM category";
                        // Thực hiện truy vấn
                        $res = mysqli_query($conn, $sql);
                        // Đếm dòng
                        $count = mysqli_num_rows($res);

                    ?>
                    <h1><?php echo $count ?></h1>
                    <br>
                    Categories
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql2 = "SELECT * FROM food";
                        // Thực hiện truy vấn
                        $res2 = mysqli_query($conn, $sql2);
                        // Đếm dòng
                        $count2 = mysqli_num_rows($res2);

                    ?>
                    <h1><?php echo $count2 ?></h1>
                    <br>
                    Foods
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql3 = "SELECT * FROM `order`";
                        // Thực hiện truy vấn
                        $res3 = mysqli_query($conn, $sql3);
                        // Đếm dòng
                        $count3 = mysqli_num_rows($res3);

                    ?>
                    <h1><?php echo $count3 ?></h1>
                    <br>
                    Total Orders
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql7 = "SELECT * FROM `category` WHERE active = 'Yes'";
                        // Thực hiện truy vấn
                        $res7 = mysqli_query($conn, $sql7);
                        // Đếm dòng
                        $count7 = mysqli_num_rows($res7);

                    ?>
                    <h1><?php echo $count7 ?></h1>
                    <br>
                    Actived Category
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql8 = "SELECT * FROM `food` WHERE active = 'Yes'";
                        // Thực hiện truy vấn
                        $res8 = mysqli_query($conn, $sql8);
                        // Đếm dòng
                        $count8 = mysqli_num_rows($res8);

                    ?>
                    <h1><?php echo $count8 ?></h1>
                    <br>
                    Actived Food
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql4 = "SELECT SUM(total) AS Total FROM `order` WHERE status = 'Delivered'";
                        // Thực hiện truy vấn
                        $res4 = mysqli_query($conn, $sql4);
                        // Lất thông tin
                        $row4 = mysqli_fetch_assoc($res4);
                        // Lấy total revenue
                        $total_revenue = $row4['Total'];
 
                    ?>
                    <h1><?php echo "$".number_format($total_revenue, "1") ?></h1>
                    <br>
                    Revenue
                </div>

                <div class="col-4 text-center">
                    <?php 
                        // Truy vấn
                        $sql5 = "SELECT SUM(wage) AS Total_wage FROM `staff`";
                        // Thực hiện truy vấn
                        $res5 = mysqli_query($conn, $sql5);
                        // Lất thông tin
                        $row5 = mysqli_fetch_assoc($res5);
                        // Lấy total revenue
                        $total_wage = $row5['Total_wage'];
 
                    ?>
                    <h1><?php echo "$".number_format($total_wage, "1") ?></h1>
                    <br>
                    Total wage
                </div>

                <div class="clearfix"></div>
                
                <br><br><br>
                <h2>
                    <img width="50" height="50" src="https://img.icons8.com/external-vitaliy-gorbachev-flat-vitaly-gorbachev/58/external-fire-emergency-vitaliy-gorbachev-flat-vitaly-gorbachev.png" alt="external-fire-emergency-vitaliy-gorbachev-flat-vitaly-gorbachev"/>
                    BEST SELLER
                    <img width="50" height="50" src="https://img.icons8.com/external-vitaliy-gorbachev-flat-vitaly-gorbachev/58/external-fire-emergency-vitaliy-gorbachev-flat-vitaly-gorbachev.png" alt="external-fire-emergency-vitaliy-gorbachev-flat-vitaly-gorbachev"/>
                </h2>
                <br>
                
        <table class="tbl-full text-20">
            <tr>
                <th class="text-center">S.N</th>
                <th>Food</th>
                <th class="text-center">Total</th>
            </tr>

            <?php
                // Lấy thông tin từ DB
                // Truy vấn
                $sql9 = "SELECT `order`.food, SUM(qty) AS total_sold FROM `order`
                WHERE status = 'Delivered'
                GROUP BY food
                ORDER BY total_sold DESC
                LIMIT 10
                ";
                // Thực hiện truy vấn
                $res9 = mysqli_query($conn, $sql9);
                // Đếm số dòng
                $count9 = mysqli_num_rows($res9);
                if($count9 > 0){
                    // Order available
                    $sn=1;
                    while ($row = mysqli_fetch_assoc($res9)){
                        $food = $row['food'];
                        $total_sold = $row['total_sold'];
                        ?>
                        <tr>
                            <td class="text-center">
                                <?php 
                                    if($sn == 1){
                                        ?>
                                        <img width="25" height="25" src="https://img.icons8.com/color/50/gold-medal--v1.png" alt="gold-medal--v1"/>
                                        <?php $sn++;
                                    }else if($sn == 2){
                                        ?>
                                        <img width="25" height="25" src="https://img.icons8.com/color/50/olympic-medal-silver.png" alt="olympic-medal-silver"/>                                        
                                        <?php $sn++;
                                    }else if($sn == 3){
                                        ?>
                                        <img width="25" height="25" src="https://img.icons8.com/color/50/olympic-medal-bronze.png" alt="olympic-medal-bronze"/>                                        
                                        <?php $sn++;
                                    }else{
                                        echo $sn++; 
                                    }
                                ?>
                            </td>
                            <td><?php echo $food; ?></td>
                            <td class="text-center"><?php echo $total_sold; ?></td>
                        </tr>
                        <?php
                    }
                }else{
                    // Order not available
                    echo "<tr><td colspan='12'>Order not available</td></tr>";
                }
            ?>

            
       
        </table>

            </div>
        </div>
        <!-- Kết thúc Main Content Section -->

<?php include('partials/footer.php'); ?>        
