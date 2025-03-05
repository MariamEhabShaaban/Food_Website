<?php
require_once 'partials/menu.php';
?>

<div class="main-content">
    <div class="warpper">
        <h1>Add Category</h1>
        <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }
        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>
        <br><br>
        <!-- Add category form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" placeholder="title" name="title"></td>
                </tr>
                <tr>
                    <td>Image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Featured :</td>
                    <td><input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>Active :</td>
                    <td><input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="add-category" value="Add Category" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>


        <!-- Add category form end -->
    </div>
</div>




<?php
if (isset($_POST['add-category'])) {
    $title = $_POST['title'];
    $featured = "No";
    if (isset($_POST['featured'])) {
        $featured = $_POST['featured'];
    }




    $active = "No";
    if (isset($_POST['active'])) {
        $active = $_POST['active'];
    }
    // image is selected or not
    $image_name = "";
    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name']) ) {
        // Upload the Image
        // to upload image we need image name and      source , destination
       

        $image_name = $_FILES['image']['name'];

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
            header("location" . SITEURL . "admin/add-category.php");
        }

    }
    $sql = "INSERT INTO category (`title`,`active`,`featured`,`image_name`) VALUES ('$title','$active','$featured','$image_name')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['add-category'] = "<div class='success'> The category added successfully</div>";
        header("location:" . SITEURL . "admin/manage-category.php");

    } else {
        $_SESSION['add-category'] = "<div class='error'>Failed to add category</div>";
        header("location:" . SITEURL . "admin/add-category.php");
    }


}

?>










<?php
require_once 'partials/footer.php';
?>