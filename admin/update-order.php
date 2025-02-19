<?php include('partials/menu.php') ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            // Kiểm tra id isset ?
            if(isset($_GET['id'])){
                // Lấy thông tin
                $id = $_GET['id'];

                // Truy vấn
                $sql = "SELECT * FROM `order` WHERE id = $id";
                // Thực hiện truy vấn
                $res = mysqli_query($conn, $sql);
                // Đếm dòng
                $count = mysqli_num_rows($res);

                if($count == 1){
                    // Có dữ liệu
                    $row = mysqli_fetch_assoc($res);

                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];

                }else{
                    // Details not available
                    header('location:'.SITE_URL.'admin/manage-order.php');
                }
            }else{
                // Chuyển hướng
                header('location:'.SITE_URL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="post">
            <table class="tbl-30">
                <tr>
                    <td>Food Name: </td>
                    <td><b><?php echo $food ?></b></td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>$ <b><?php echo number_format($price, 2) ?></b></td>
                </tr>

                <tr>
                    <td>Qty: </td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty ?>" min="1" step="1">
                    </td>
                </tr>

                <tr>
                    <td>Status: </td>
                    <td>
                        <select name="status">
                            <option <?php if($status == "Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status == "On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status == "Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email ?>">
                    </td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea name="customer_address" cols="50" rows="5"><?php echo $customer_address ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="hidden" name="price" value="<?php echo $price ?>">
                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 

            // Kiểm tra ấn submit
            if(isset($_POST['submit'])){
                // Lấy thông tin từ form trên
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];
                $customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['customer_contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['customer_email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['customer_address']);

                $sql2 = "UPDATE `order` SET
                qty = $qty,
                total = $total,
                status = '$status',
                customer_name = '$customer_name',
                customer_contact = '$customer_contact',
                customer_email = '$customer_email',
                customer_address = '$customer_address'
                WHERE id = $id
                ";
                // Thực hiện truy vấn
                $res2 = mysqli_query($conn, $sql2);

                // Kiểm tra update thành công ko?
                if($res2 == TRUE){
                    $_SESSION['update'] = "<div class='success'>Order updated successfully</div>";
                    header('location:'.SITE_URL.'admin/manage-order.php');
                }else{  
                    $_SESSION['update'] = "<div class='error'>Failed to update</div>";
                    header('location:'.SITE_URL.'admin/manage-order.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>