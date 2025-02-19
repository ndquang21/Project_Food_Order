<?php include('partials-front/menu.php') ?>

<?php
    // Kiểm tra food_id isset?
    if(isset($_GET['food_id'])){
        // Lấy thông tin
        $food_id = $_GET['food_id'];

        $sql = "SELECT * FROM food WHERE id = $food_id";
        // Thực hiện truy vấn
        $res = mysqli_query($conn, $sql);
        // Đếm số dòng
        $count = mysqli_num_rows($res);
        // Kiểm tra có dòng nào không
        if($count == 1){
            // Có data
            $row = mysqli_fetch_assoc($res);
            // Lấy thông tin
            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }else{
            // Food not available
            header('location:'.SITE_URL);
        }
    }else{
        header('location:'.SITE_URL);
    }
?>

<!-- Bắt đầu Food Order Section -->
<section class="order-page-bgImg">
    <div class="container">
        
        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="" class="order" method="post">
            <fieldset>
                <legend style="font-weight: bold;">Selected Food</legend>

                <div class="food-menu-img">
                    <?php 
                        // Kiểm tra có ảnh không
                        if($image_name == ""){
                            // Ko có
                            echo "<div class='error'>Image not available.</div>";
                        }else{
                            // Có
                            ?>
                            <img src="<?php echo SITE_URL ?>images/food/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve img-square">
                            <?php
                        }
                    ?>
                </div>

                <div class="food-menu-desc">
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name = "food" value= "<?php echo $title ?>">

                    <p class="food-price">Price per serving: $<?php echo $price ?></p>
                    <input type="hidden" name="price" value="<?php echo $price ?>">

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" min="1" step="1" required>
                    
                </div>

            </fieldset>
            
            <fieldset>
                <legend  style="font-weight: bold;">Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="E.g. Duc Quang" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. +84 1234xxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. asdfgh@gmail.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. nhà số X, ngõ Y, phố Z, quận T" class="input-responsive" required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>

        <?php 
        // Kiểm tra nút submit
        if(isset($_POST['submit'])){
            $food = $_POST['food'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty;
            $order_date = date("Y-m-d h:i:sa");
            $status = "Ordered"; // Ordered, Undelivery, Delivered, Cancelled
            $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
            $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
            $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
            $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

            // Lưu order vào DB
            $sql2 = "INSERT INTO `order` SET
            food = '$food',
            price = $price,
            qty = $qty,
            total = $total,
            order_date = '$order_date',
            status = '$status',
            customer_name = '$customer_name',
            customer_contact = '$customer_contact',
            customer_email = '$customer_email',
            customer_address = '$customer_address'
            ";
            // Thực hiện truy vấn
            $res2 = mysqli_query($conn, $sql2);
            // Kiểm tra truy vấn có thành công
            if($res2 == true){
                // Thành công
                $_SESSION['order'] = "<br><div class='success text-center'>Food order successfully</div>";
                header('location:'.SITE_URL);
            }else{
                // Thất bại
                $_SESSION['order'] = "<br><div class='error text-center'>Failed to order</div>";
                header('location:'.SITE_URL);
            }


        }
        ?>

    </div>
</section>
<!-- Kết thúc Food Order Section -->

<?php include('partials-front/footer.php') ?>