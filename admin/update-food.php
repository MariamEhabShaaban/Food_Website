<?php require_once("partials/menu.php");?>
<div class="main-content">
    <div class="warpper">

        <h1>Update Food</h1>
        <br><br>
        <?php if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM food WHERE id='$id'";
            $result=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($result);
            if($count==1){
                $row=mysqli_fetch_array($result);
                $id=$row["id"];
                $title=$row['title'];
                $desc=$row['description'];
                $price=$row['price'];
                $category=$row['category_id'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                 $_SESSION['no-food-found']="<div class='error'>No Food Found</div>";
                header("location:".SITEURL.'admin/manage-food.php');
            }
        }
        else {
            header("location:".SITEURL.'admin/manage-food.php');
        }
            
            ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" placeholder="title" name="title" value="<?php echo $title?>"></td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td><textarea type="text" placeholder="description" name="desc"><?php echo $desc?></textarea></td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td><input type="number" placeholder="price" name="price" value="<?php echo $price?>"></td>
                </tr>
                <tr>
                    <td>Current Image:</td>
                    <td>
                        <?php 
                        if($current_image!=""){
                            // Display the image
                            ?>
                            <img  width="100px" src="<?php echo SITEURL?>images/food/<?php echo $current_image?>">
                            <?php 
                        }
                        else{
                             echo "<div class='error'>No Image</div>";
                        }
                        ?>
                    </td>
                </tr>


                <tr>
                    <td>New Image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category" >
                            <!-- diplay all Categories -->
                            <?php
                            $sql2 = "SELECT * FROM category WHERE active='yes'";
                            $result2 = mysqli_query($connect, $sql2);
                            $count2 = mysqli_num_rows($result2);
                            if ($count2 > 0) {
                                ?>
                                <?php while ($row2= mysqli_fetch_array($result2)) {
                                    ?>
                                    <option value=<?php echo $row2['id'] ?>><?php echo $row2['title'] ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="-1">No Category Found</option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td><input   <?php if($featured=='yes') {echo 'checked';}?> type="radio" name="featured" value="yes">Yes
                        <input <?php if($featured=='no') {echo 'checked';}?> type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td><input  <?php if($active=='yes') {echo 'checked';}?> type="radio" name="active" value="yes">Yes
                        <input  <?php if($active=='no') {echo 'checked';}?> type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="current_image" value=<?php echo $current_image?>>
                        <input type="hidden" name="id" value=<?php echo $id?>>
                        <input type="submit" name="update-food" value="Update Food" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        
        <?php
     if(isset($_POST['update-food'])){

            $title=$_POST['title'];
           $id=$_POST['id'];
           $price=$_POST['price'];
           $category=$_POST['category'];
           $desc=$_POST['desc'];
           $current_image=$_POST['current_image'];
           $featured=$_POST['featured'];
           $active=$_POST['active'];
         
           // Upload new image
          $image_name=$current_image;
          if(isset($_FILES['image']['name']) && !empty( $_FILES['image']['name'])){
            
            $image_name=$_FILES['image']['name'];
            if($image_name!= ''){
                $ext = explode('.', $image_name);

                // return the last element
        
                $ext = end($ext);
        
                // rename image
        
                $image_name = "food_" . rand(0, 1000) . "." . $ext;
        
                $source_path = $_FILES['image']['tmp_name'];
        
                $dest_path = "../images/food/" . $image_name;
        
                $upload = move_uploaded_file($source_path, $dest_path);
        
                // check image is uploaded or not
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    // Redirect to category page
                    header("location" . SITEURL . "admin/manage-food.php");
                }
                if($current_image!=""){
                $remove_path="../images/food/".$current_image;
                $remove=unlink($remove_path);
                if($remove==false){
                    $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current image</div>";
                    header("location" . SITEURL . "admin/manage-food.php");
                }
                else
                {

                    $_SESSION["failed-remove"]="<div class='success'>Current Image remove successfully</div>";
                }
            
                
        
            }
        }
        }
    

     

           //update the database

          $sql2="UPDATE food SET title='$title',
          featured='$featured',
          active='$active',image_name='$image_name',description='$desc',
          price=$price
          WHERE id='$id'";

          $result2=mysqli_query($connect,$sql2);
          if($result2){
            $_SESSION['update-food']="<div class='success'>The Food updated successfully</div>";
            header("location:".SITEURL."admin/manage-food.php");
          }
         else{
            $_SESSION['update-food']="<div class='error'>Failed to update food</div>";
            header("location:".SITEURL."admin/manage-food.php");
        }





           // redirect to manage category 

           
           
    
 }
        
        
        ?>
        

            
    </div>
</div>












<?php require_once("partials/footer.php");?>