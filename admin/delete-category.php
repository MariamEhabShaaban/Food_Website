<?php
require_once("../config/constants.php");
if(isset($_GET['id']) && isset( $_GET['image_name'])) {
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];
    $sql="DELETE FROM category WHERE id='$id'";
    $result=mysqli_query($connect,$sql);
    if($result){
        $_SESSION['delete-category']="<div class='success'>The Category Deleted Successfully</div>";
        if($image_name!=""){
            $path="../images/category/".$image_name;
            $remove=unlink($path);
        }
    }
    else{
        $_SESSION['delete-category']="<div class='error'>Failed To Delete Category</div>"; 
    }

header("location:".SITEURL."admin/manage-category.php");
}
?>