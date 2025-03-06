<?php require "partials-front/menu.php" ?>
<?php
if (isset($_GET['food_id'])) {
    $id = $_GET['food_id'];
    $sql = "SELECT * FROM food WHERE id=$id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $title = $row['title'];
    $image_name = $row['image_name'];
    $price = $row['price'];
    



}



?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search">
    <div class="container">

        <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

        <form action="add-order.php" class="order" method="POST">
            <fieldset>
                <legend>Selected Food</legend>

                <div class="food-menu-img">
                    <?php
                    if ($image_name == "") {
                        echo "<div class='error'>Image not available</div>";
                    } else {
                        ?>
                        <img src="images/food/<?php echo $image_name ?>" alt="" class="img-responsive img-curve">
                        <?php
                    }
                    ?>

                </div>

                <div class="food-menu-desc">
                    <input type="hidden" name="food" value="<?php echo $title ?>">
                    <h3><?php echo $title ?></h3>
                    <input type="hidden" name="price" value="<?php echo $price ?>">
                    <p class="food-price">$<?php echo $price ?></p>

                    <div class="order-label">Quantity</div>
                    <input type="number" name="qty" class="input-responsive" value="1" required>

                </div>

            </fieldset>

            <fieldset>
                <legend>Delivery Details</legend>
                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" placeholder="Enter Your Name" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" placeholder="E.g. hi@vijaythapa.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive"
                    required></textarea>

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
            </fieldset>

        </form>


       
    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php require "partials-front/footer.php" ?>