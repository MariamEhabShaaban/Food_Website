<?php
ob_start();
require 'partials/menu.php';
?>
<div class="main-content">
    <div class="warpper">
        <br><br>
        <h1>Change password</h1>
        <br><br><br>
        <form action="" method="POST">
            <input type="hidden" name="id" value="<?php echo$_GET['id'] ?>" ;>
            <table class="tbl-30">
                <tr>
                    <td>Current password :</td>
                    <td><input type="password" placeholder="Old password" name="old-password"></td>
                </tr>
                <tr>
                    <td>New password :</td>
                    <td><input type="password" placeholder="new password" name="new-pass"></td>
                </tr>
                <tr>
                    <td>Confirm password :</td>
                    <td><input type="password" placeholder="confirm password" name="confirm-pass"></td>
                </tr>
                <tr>

                    <td><input type="submit" name="change-pass" value="Change password" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>
<?php require 'partials/footer.php'; ?>
<?php
if (isset($_POST['change-pass'])) {

    // check current password is correct
    $id = $_POST['id'];
    $pass=md5($_POST['old-password']);
    $sql = "SELECT * FROM admin WHERE id=? AND password=?";

    $stm = $connect->prepare($sql) or die(mysqli_error($connect));
    $stm->bind_param('is', $id,$pass);
    $stm->execute();
    $result = $stm->get_result();
    $admin = $result->fetch_assoc();
    

    
    if ($admin) {
        $new_pass = $_POST["new-pass"];
        $confirm_pass=$_POST['confirm-pass'];
        if($new_pass!=$confirm_pass){
            $_SESSION["change-pass"] = "<div class='error'>Confirm password don't match password</div>"; 
             header("location:".SITEURL."admin/manage-admin.php");
             exit();
        }
        $_SESSION["change-pass"] = "<div class='success'>password change successfully</div>";

        $sql = "UPDATE admin SET password =?  WHERE id=?";
        $stm = $connect->prepare($sql) or die(mysqli_error($connect));
        $stm->bind_param("si", $new_pass, $id);
        $res = $stm->execute();
    }
    else{
        $_SESSION["change-pass"] = "<div class='error'>User not found or password wrong</div>"; 
    }
    header("location:".SITEURL."admin/manage-admin.php");


}

?>