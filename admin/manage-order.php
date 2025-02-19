<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <br><br><br>

        <?php 
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <br>
        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Action</th>
            </tr>

            <?php
                // Lấy thông tin từ DB
                // Truy vấn
                $sql = "SELECT * FROM `order` ORDER BY id DESC";
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // Đếm số dòng
                $count = mysqli_num_rows($res);
                if($count > 0){
                    // Order available
                    $sn=1;
                    while ($row = mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                        ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $food; ?></td>
                            <td class="text-center"><?php echo "$".number_format($price, 1); ?></td>
                            <td class="text-center"><?php echo $qty; ?></td>
                            <td><?php echo number_format($total, 1); ?></td>
                            <td><?php echo $order_date; ?></td>
                            <td>
                                <?php // Tùy chỉnh màu cho các status
                                    if($status == "Ordered"){
                                        echo "<label class='text-center'>$status</label>";
                                    }else if($status == "On Delivery"){
                                        echo "<label class='text-center' style='color: orange'>$status</label>";
                                    }else if($status == "Delivered"){
                                        echo "<label class='text-center' style='color: green'>$status</label>";
                                    }else if($status == "Cancelled"){
                                        echo "<label class='text-center' style='color: red'>$status</label>";
                                    }
                                ?>
                            </td>
                            <td><?php echo $customer_name; ?></td>
                            <td><?php echo $customer_contact; ?></td>
                            <td><?php echo $customer_email; ?></td>
                            <td><?php echo $customer_address; ?></td>
                            <td>
                                <a href="<?php echo SITE_URL ?>admin/update-order.php?id=<?php echo $id ?>" class="btn-secondary">Update Order</a>
                            </td>
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

<?php include('partials/footer.php'); ?>