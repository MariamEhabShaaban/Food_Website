<?php require "partials-front/menu.php"?>



    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php   
            $sql="SELECT * FROM category WHERE active='yes'";
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
                <img src="<?php echo SITEURL?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve">
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


  

    <?php require "partials-front/footer.php"?>