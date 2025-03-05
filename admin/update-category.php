<?php require_once("partials/menu.php");?>
<div class="main-content">
    <div class="warpper">

        <h1>Update Category</h1>
        <br><br>
        <?php if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM category WHERE id='$id'";
            $result=mysqli_query($connect,$sql);
            $count=mysqli_num_rows($result);
            if($count==1){
                $row=mysqli_fetch_array($result);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured=$row['featured'];
                $active=$row['active'];
            }
            else{
                 $_SESSION['no-category-found']="<div class='error'>No Category Found</div>";
                header("location:".SITEURL.'admin/manage-category.php');
            }
        }
        else {
            header("location:".SITEURL.'admin/manage-category.php');
        }
            
            ?>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" placeholder="title" name="title" value="<?php echo $title?>"></td>
                </tr>
                <tr>
                    <td>Current Image :</td>
                    <td>
                        <?php 
                        if($current_image!=""){
                            // Display the image
                            ?>
                            <img  width="100px" src="<?php echo SITEURL?>images/category/<?php echo $current_image?>">
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
                        <input type="submit" name="update-category" value="Update Category" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>
        <?php
     if(isset($_POST['update-category'])){
            $title=$_POST['title'];
           $id=$_POST['id'];
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
        
                $image_name = "food_cat_" . rand(0, 1000) . "." . $ext;
        
                $source_path = $_FILES['image']['tmp_name'];
        
                $dest_path = "../images/category/" . $image_name;
        
                $upload = move_uploaded_file($source_path, $dest_path);
        
                // check image is uploaded or not
                if (!$upload) {
                    $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                    // Redirect to category page
                    header("location" . SITEURL . "admin/manage-category.php");
                }
                if($current_image!=""){
                $remove_path="../images/category/".$current_image;
                $remove=unlink($remove_path);
                if($remove==false){
                    $_SESSION["failed-remove"] = "<div class='error'>Failed to remove current image</div>";
                    header("location" . SITEURL . "admin/manage-category.php");
                }
                else
                {

                    $_SESSION["failed-remove"]="<div class='success'>Current Image remove successfully</div>";
                }
                }
                
        
            }

     }

           //update the database

          $sql2="UPDATE category SET title='$title',
          featured='$featured',
          active='$active',image_name='$image_name'
          WHERE id='$id'";

          $result2=mysqli_query($connect,$sql2);
          if($result2){
            $_SESSION['update-category']="<div class='success'>The category updated successfully</div>";
            header("location:".SITEURL."admin/manage-category.php");
          }
         else{
            $_SESSION['update-category']="<div class='error'>Failed to update category</div>";
            header("location:".SITEURL."admin/manage-category.php");
        }





           // redirect to manage category 

           
           }
        
        
        ?>
        

            
    </div>
</div>












<?php require_once("partials/footer.php");?>