<?php require 'partials/menu.php'; ?>

<div class="main-content">
    <div class="warpper">
        <h1>Manage Food</h1>
        <br><br>
        <?php
        if(isset( $_SESSION['add-food'] )){
            echo  $_SESSION['add-food'] ;
            unset( $_SESSION['add-food'] );
        }
        if(isset( $_SESSION['delete-food'] )){
            echo $_SESSION['delete-food'];
            unset($_SESSION['delete-food']);
        }
        if(isset( $_SESSION['upload'] )){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        if(isset( $_SESSION['no-food-found'])){
            echo  $_SESSION['no-food-found'];
            unset( $_SESSION['no-food-found']);
        }
        if(isset(  $_SESSION['update-food'])){
            echo  $_SESSION['update-food'];
            unset( $_SESSION['update-food']);
        }
        
        
        ?>
        <br><br>
        <a href="<?php echo SITEURL.'admin/add-food.php'?>" class="btn-primary">Add Food</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            // Get all food from database
            $sql="SELECT * FROM food";
            $result=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($result);
            if($count> 0){
                $inc=1;
            while($row=mysqli_fetch_array($result)){
                $id=$row["id"];
                $image_name=$row["image_name"];
             ?>
            <tr>
                <td><?php echo $inc++?></td>
                <td><?php echo $row['title']?></td>
                <td><?php echo $row['price'] ." $"?></td>
                <td>
                <?php if ($row['image_name'] != "") {
                                ?>
                                <img src="<?php echo SITEURL ?>images/food/<?php echo $image_name ?>" width="100px"
                                    alt="">
                                <?php

                                // Display Image
                    
                            } else {
                                // Dispaly MS
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            ?>
                </td>
                <td><?php echo $row['featured'] ?></td>
                <td><?php echo $row['active'] ?></td>
                <td> <a href="<?php echo SITEURL."admin/delete-food.php?id=$id&image_name=$image_name"?>" class="btn-danger">Delete</a> <a href="<?php echo SITEURL."admin/update-food.php?id=$id&image_name=$image_name"?>" class="btn-secondary">Update</a></td>
            </tr>
            <tr></tr>

            <?php
            }
        }
            else{
                ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Food Added</div>
                    </td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
</div>




<?php require 'partials/footer.php'; ?>