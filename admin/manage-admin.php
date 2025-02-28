<?php require 'partials/menu.php'; ?>
<!-- Menu Section End -->

<!-- Main content Section Start -->
<div class="main-content">
    <div class="warpper">
        <h1>Manage Admin</h1>

        <br><br>
        <?php if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['change-pass'])) {
            echo $_SESSION['change-pass'];
            unset($_SESSION['change-pass']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        ?>
        <br><br><br>
        <a href="add-admin.php" class="btn-primary">Add Admin</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Actions</th>
            </tr>
            <!-- get all admins from database -->
            <?php
            $sn = 1;
            $sql = "SELECT * FROM admin";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                $count = mysqli_num_rows($result);
                if ($count > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row["id"];
                        $full_name = $row["full_name"];
                        $user_name = $row['username'];
                        ?>
                        <tr>
                            <td><?php echo $sn++ ?></td>
                            <td><?php echo $full_name ?></td>
                            <td><?php echo $user_name ?></td>
                            <td>
                                <a href="<?php echo SITEURL ?>admin/change-adminpass.php?id= <?php echo $id ?>"
                                    class="btn-primary">Change Password</a>
                                <a href="<?php echo SITEURL ?>admin/delete-admin.php?id= <?php echo $id ?>"
                                    class="btn-danger">Delete</a>
                                <a href="<?php echo SITEURL ?>admin/update-admin.php?id= <?php echo $id ?>"
                                    class="btn-secondary">Update</a>
                            </td>
                        </tr>

                        <?php
                    }

                } else {

                }
            }
            ?>

        </table>
    </div>

</div>
<!-- Main content Section End -->
<?php require 'partials/footer.php'; ?>