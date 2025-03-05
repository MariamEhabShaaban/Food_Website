<?php require_once 'partials/menu.php'; ?>

<div class="main-content">
    <div class="warpper">
        <h1>Add Food</h1>

        <br><br>
        <!-- Add Food form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title :</td>
                    <td><input type="text" placeholder="title" name="title"></td>
                </tr>
                <tr>
                    <td>Description :</td>
                    <td><textarea type="text" placeholder="description" name="desc"></textarea></td>
                </tr>
                <tr>
                    <td>Price :</td>
                    <td><input type="number" placeholder="price" name="price"></td>
                </tr>


                <tr>
                    <td>Image :</td>
                    <td><input type="file" name="image"></td>
                </tr>
                <tr>
                    <td>Category :</td>
                    <td>
                        <select name="category">
                            <!-- diplay all Categories -->
                            <?php
                            $sql = "SELECT * FROM category WHERE active='yes'";
                            $result = mysqli_query($connect, $sql);
                            $count = mysqli_num_rows($result);
                            if ($count > 0) {
                                ?>
                                <?php while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <option value=<?php echo $row['id'] ?>><?php echo $row['title'] ?></option>
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
                        <input type="submit" name="add-food" value="Add Food" class="btn-primary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>


<?php require_once 'partials/footer.php'; ?>

<?php
if (isset($_POST['add-food'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // exit;
    $title = $_POST['title'];
    $description = $_POST['desc'];
    $category = $_POST['category'];
    $price = $_POST['price'];

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
    if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {
        // Upload the Image
        // to upload image we need image name and      source , destination


        $image_name = $_FILES['image']['name'];

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
            header("location" . SITEURL . "admin/add-food.php");
        }

    }
    $sql = "INSERT INTO food (`title`,`active`,`featured`,`image_name`,`category_id`,`price`,`description`) VALUES ('$title','$active','$featured','$image_name','$category',$price,'$description')";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['add-food'] = "<div class='success'> The food added successfully</div>";
        header("location:" . SITEURL . "admin/manage-food.php");

    } else {
        $_SESSION['add-food'] = "<div class='error'>Failed to add food</div>";
        header("location:" . SITEURL . "admin/add-food.php");
    }


}


?>