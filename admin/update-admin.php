<?php
require 'partials/menu.php';
?>
<div class="main-content">
    <div class="warpper">

        <h1>Update Admin</h1>
        <br><br>
        <?php
        // GET admin from database
        $id = $_GET['id'];
        $sql = "SELECT * FROM admin WHERE id=?";

        $stm = $connect->prepare($sql) or die(mysqli_error($connect));
        $stm->bind_param('i', $id);
        $stm->execute();
        $result = $stm->get_result();
        $admin = $result->fetch_assoc();
        $full_name = '';
        $user_name = '';

        if ($admin) {
            $full_name = $admin['full_name'];
            $user_name = $admin['username'];
        }
        ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td><input type="text" placeholder="enter your name" name="full-name"
                            value="<?php echo $full_name ?>"></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="text" placeholder="enter your username" name="username"
                            value="<?php echo $user_name ?>"></td>
                </tr>
                <tr>

                    <td><input type="submit" name="update" value="Update-Admin" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php require "partials/footer.php" ?>
<?php
if (isset($_POST["update"])) {
    $full_name = mysqli_real_escape_string( $connect,$_POST['full-name']);
    $user_name = mysqli_real_escape_string( $connect,$_POST['username']);
    $sql = "UPDATE admin SET full_name =? ,username=? WHERE id=?";
    $stm = $connect->prepare($sql) or die(mysqli_error($connect));
    $stm->bind_param("ssi", $full_name, $user_name, $id);
    $res = $stm->execute();
    if ($res) {
        $_SESSION['update'] = "<div class='success'> Admin Updated successfully</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
    } else {
        $_SESSION['update'] = "<div class='success'>Failed To Update</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
    }

}



?>