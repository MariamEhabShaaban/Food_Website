<?php require 'partials/menu.php'; ?>
<!-- Menu Section End -->

<!-- Main content Section Start -->
<div class="main-content">
    <div class="warpper">
        <h1>DASHBOARD</h1>
        <div class="col-4 text-center">
            <?php
              $sql="SELECT * FROM category";
              $result=mysqli_query($connect,$sql);
              $count=mysqli_num_rows($result);
            
            ?>
            <h1><?php echo $count?></h1>
            <br>

            Categories

        </div>

        <div class="col-4 text-center">
            <?php
              $sql="SELECT * FROM food";
              $result=mysqli_query($connect,$sql);
              $count=mysqli_num_rows($result);
            
            ?>
            <h1><?php echo $count?></h1>
            <br>

            Foods

        </div>

        <div class="col-4 text-center">
            <?php
              $sql="SELECT * FROM `order`";
              $result=mysqli_query($connect,$sql);
              $count=mysqli_num_rows($result);
            
            ?>
             <h1><?php echo $count?></h1>
            <br>

            Total Orders

        </div>

        <div class="col-4 text-center">
             <?php
              $sql="SELECT SUM(total) AS Total FROM `order` WHERE status='Delivered'";
              $result=mysqli_query($connect,$sql);
              $row=mysqli_fetch_array($result);
              $revenue=$row['Total'];
            
            ?>
            <h1>$<?php echo $revenue?></h1>
            <br>

            Revenue Generated

        </div>
        <div class="clear-fix"></div>

    </div>
</div>
<!-- Main content Section End -->

<!-- Footer Section Start -->
<?php require 'partials/footer.php'; ?>
<!-- Footer Section End -->