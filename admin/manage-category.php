<?php require 'partials/menu.php'; ?>


<div class="main-content">
    <div class="warpper">
        <h1>Manage Category</h1>
        <br><br>
        <?php
        if (isset($_SESSION['add-category'])) {
            echo $_SESSION['add-category'];
            unset($_SESSION['add-category']);
        }
        if (isset($_SESSION['delete-category'])) {
            echo $_SESSION['delete-category'];
            unset($_SESSION['delete-category']);
        }

        if (isset( $_SESSION['no-category-found'])) {
            echo  $_SESSION['no-category-found'];
            unset( $_SESSION['no-category-found']);
        }

        if(isset($_SESSION['update-category'])){
            echo $_SESSION['update-category'];
            unset($_SESSION['update-category']);
        }
        if(isset($_SESSION['upload'])){
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }


        ?>
        <br><br>
        <a href="add-category.php" class="btn-primary">Add Category</a>
        <br><br>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "SELECT * FROM category";
            $result = mysqli_query($connect, $sql);
            $count = mysqli_num_rows($result);
            if ($count > 0):
                $id = 1;
                while ($row = mysqli_fetch_array($result)) {

                    ?>
                    <tr>
                        <td><?php echo $id++ ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td>
                            <?php if ($row['image_name'] != "") {
                                ?>
                                <img src="<?php echo SITEURL ?>images/category/<?php echo $row['image_name'] ?>" width="100px"
                                    alt="">
                                <?php

                                // Display Image
                    
                            } else {
                                // Dispaly MS
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            ?>
                        </td>
                        <td><?php echo $row['featured'] ?></td>
                        <td><?php echo $row['active'] ?></td>
                        <td> <a href="delete-category.php?id=<?php echo $row['id']?>&image_name=<?php echo $row['image_name']?>" class="btn-danger">Delete</a> <a href="update-category.php?id=<?php echo $row['id']?>" class="btn-secondary">Update</a></td>
                    </tr>
                <?php }
                ; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">
                        <div class="error">No Category Added</div>
                    </td>
                </tr>
            <?php endif ?>

        </table>
    </div>
</div>



<?php require 'partials/footer.php'; ?>