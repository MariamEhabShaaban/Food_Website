<?php require "partials/menu.php" ?>
<div class="main-content">
    <div class="warpper">

        <h1>Add Admin</h1>
        <br><br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);

        } ?>
        <br><br>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name :</td>
                    <td><input type="text" placeholder="enter your name" name="full-name"></td>
                </tr>
                <tr>
                    <td>Username :</td>
                    <td><input type="text" placeholder="enter your username" name="username"></td>
                </tr>
                <tr>
                    <td>Password :</td>
                    <td><input type="password" placeholder="enter password" name="password"></td>
                </tr>
                <tr>

                    <td><input type="submit" name="submit" value="Add-Admin" class="btn-secondary"></td>
                </tr>
            </table>

        </form>
    </div>
</div>


<?php require "partials/footer.php" ?>
<?php


if (isset($_POST["submit"])) {
    // get data from form
    $full_name = $_POST["full-name"];
    $user_name = $_POST["username"];
    $pass = md5($_POST["password"]); //encryption

    //SQL Query to save data
    $sql = "INSERT INTO admin (`full_name`,`username`,`password`) VALUES (?,?,?)";
    $stm = $connect->prepare($sql) or die(mysqli_error($connect));
    $stm->bind_param('sss', $full_name, $user_name, $pass);
    $res = $stm->execute();
    if ($res == true) {
        $_SESSION['add'] = "<div class='success'>Admin added successfully</div>";
        header("location:" . SITEURL . "admin/manage-admin.php");
    } else {
        $_SESSION['add'] = "<div class='error'>Failed to add admin</div>";
        header("location:" . SITEURL . "admin/add-admin.php");
    }
}
