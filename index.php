<?php require "partials-front/menu.php"?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php 

    if(isset($_SESSION['order'])){
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }



    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php   
            $sql="SELECT * FROM category WHERE active='yes' AND featured='yes' LIMIT 3";
            $result=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($result);
            if($count> 0){
            while($row=mysqli_fetch_array($result)){
                $title=$row['title'];
                $id=$row['id'];
                $image_name=$row['image_name'];
            ?>

            <a href="category-foods.php?category_id=<?php echo $id?>">
            <div class="box-3 float-container">
                <?php
                if($image_name==""){
                    echo "<div class='error'>Image not available</div>";
                }
                else{
                ?>
                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" alt="" class="img-responsive img-curve">
                <?php }
                ?>

                <h3 class="float-text text-white"><?php echo $title?></h3>
            </div>
            </a>
<?php }
            }
?>
      
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <!-- fOOD Menu Section Starts Here -->
<section class="food-menu">
    <div class="container">
        <h2 class="text-center">Food Menu</h2>

        <?php
        // Fetch featured foods from the database
        $sql = "SELECT * FROM food WHERE active='yes' AND featured='yes' LIMIT 3";
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

        <p class="text-center">
            <a href="#">See All Foods</a>
        </p>
    </div>
</section>
<!-- fOOD Menu Section Ends Here -->



    <?php require "partials-front/footer.php"?>