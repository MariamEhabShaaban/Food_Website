<?php require "partials-front/menu.php" ?>


<?php

if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT * FROM category WHERE id=$category_id";
    $result = mysqli_query($connect, $sql);
    $row = mysqli_fetch_array($result);
    $category_title = $row["title"];

} else {
    header('location:' . SITEURL);
}


?>
<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
    <div class="container">

        <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title?>"</a></h2>

    </div>
</section>
<!-- fOOD sEARCH Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>


        <?php
        // Fetch featured foods from the database
        $sql = "SELECT * FROM food WHERE active='yes' AND category_id='$category_id'";
        $result = mysqli_query($connect, $sql);
        $count = mysqli_num_rows($result);

        if ($count > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = $row['title'];
                $image_name = $row['image_name'];
                $description = $row['description'];
                $price = $row['price'];
        ?>

                <div class="food-menu-box">
                    <div class="food-menu-img">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not available</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                        <?php
                        }
                        ?>
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">$<?php echo $price; ?></p>
                        <p class="food-detail">
                            <?php echo $description; ?>
                        </p>
                        <br>
                        <a href="order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                    </div>
                </div>

        <?php
            }
        } else {
            echo "<div class='error'>No Food Added</div>";
        }
        ?>



        <div class="clearfix"></div>



    </div>

</section>
<!-- fOOD Menu Section Ends Here -->



<?php require "partials-front/footer.php" ?>