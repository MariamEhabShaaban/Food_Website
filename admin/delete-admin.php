<?php
require '../config/constants.php';
$id = $_GET['id'];

$sql = "DELETE FROM admin WHERE id=?";

$stm = $connect->prepare($sql);
$stm->bind_param("i", $id);
$result = $stm->execute();

if ($result) {
    $_SESSION['delete'] = "<div class='success'>Deleted successfully</div>";
    header("location:" . SITEURL . "admin/manage-admin.php");
} else {
    $_SESSION['delete'] = "<div class='error'>Failed to delete</div>";
    header("location:" . SITEURL . "admin/manage-admin.php");
}