<?php
require_once("../config/constants.php");
if (isset($_GET['id']) && isset($_GET['image_name'])) {
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    $sql = "DELETE FROM food WHERE id='$id'";
    $result = mysqli_query($connect, $sql);
    if ($result) {
        $_SESSION['delete-food'] = "<div class='success'>The Food Deleted Successfully</div>";
        if ($image_name != "") {
            $path = "../images/food/" . $image_name;
            $remove = unlink($path);
        }
    } else {
        $_SESSION['delete-food'] = "<div class='error'>Failed To Delete Food</div>";
    }

    header("location:" . SITEURL . "admin/manage-food.php");
}