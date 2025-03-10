<?php require "partials-front/menu.php"?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
             if(isset($_POST['submit'])){
                $search = mysqli_real_escape_string( $connect,$_POST['search']);
               
                $sql="SELECT * FROM food WHERE title LIKE'%$search%' OR description LIKE '%$search%' ";
                $result = mysqli_query($connect, $sql); 
                $count=mysqli_num_rows($result);
             }
            ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>
            <?php
            // get the search keyword
               if($count> 0){
                while($row = mysqli_fetch_array($result)){
                 $title=$row['title'];
                 $id=$row['id'];
                 $price=$row['price'];
                 $description=$row['description'];
                 $image_name=$row['image_name'];



                }?>
                
                
                <div class="food-menu-box">
                <div class="food-menu-img">
                    <?php
                if($image_name==""){
                    echo "<div class='error'>Image not available</div>";
                }
                else{
                ?>
                <img src="<?php echo SITEURL?>images/food/<?php echo $image_name?>" alt="" class="img-responsive img-curve">
                <?php }
                ?>
                   
                </div>

                <div class="food-menu-desc">
                    <h4><?php echo $title?></h4>
                    <p class="food-price">$<?php echo $price?></p>
                    <p class="food-detail">
                       <?php  echo $description ?>
                    </p>
                    <br>

                    <a href="order.php?food_id=<?php echo $id?>" class="btn btn-primary">Order Now</a>
                </div>
            </div>


               <?php 
               }
               else{ 
            
               echo "<div class='error'>Food Not Found</div>";
            }
        
            
            
            ?>

        


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php require "partials-front/footer.php"?>