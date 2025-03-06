<?php require_once("partials/menu.php")?>
<div class="main-content">
    <div class="warpper">
        <h1>Update Order</h1>
        <br><br>

        <?php
            if(isset($_GET['id'])){
              
                $id = $_GET['id'];
            
                $sql="SELECT * FROM `order` WHERE id='$id'";
                $result = mysqli_query($connect,$sql);
                $count=mysqli_num_rows($result);
                if($count==1){
                $row = mysqli_fetch_array($result);
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['quantity'];
                $status = $row['status'];
                $customer_name=$row['customer_name'];
                $customer_email=$row['customer_email'];
                $customer_contact=$row['customer_contact'];
                $customer_address=$row['customer_address'];
                }
                else{
                    $_SESSION['no-order-found']="<div class='error'>No Food Found</div>";
                    header('location:'.SITEURL."admin/manage-order.php");
                }


            
            }
            else{
                header('location:'.SITEURL."admin/manage-order.php");
            }
        
        
        
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name:</td>
                    <td><?php echo $food?></td>
                </tr>
                <tr>
                    <td>Price: </td>
                    <td>$ <?php echo $price ?></td>
                </tr>
                <tr>

                    <td>Quantity:</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty?>">
                    </td>
                </tr>
                <tr>
                    <td>Status:</td>
                    <td>
                        <select name="status">
                            <option <?php echo $status=="Ordered"?'selected':''?> value="Ordered">Ordered</option>

                            <option <?php echo $status=="On Delivery"?'selected':''?> value="On Delivery">On Delivery</option>


                            <option <?php echo $status=="Delivered"?'selected':''?> value="Delivered">Delivered</option>
                            <option <?php echo $status=="Cancelled"?'selected':''?> value="Cancelled">Cancelled</option>


                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Customer Name: </td>
                    <td>
                        <input type="text" name="customer_name" value="<?php echo $customer_name?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Contact: </td>
                    <td>
                        <input type="text" name="customer_contact" value="<?php echo $customer_contact?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Email: </td>
                    <td>
                        <input type="text" name="customer_email" value="<?php echo $customer_email?>">
                    </td>
                </tr>
                <tr>
                    <td>Customer Address: </td>
                    <td>
                        <textarea  name="customer_address"><?php echo $customer_address?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input class="btn btn-secondary" type="submit" name="submit" value="Update Order" >
                    </td>
                </tr>

            </table>

        </form>
    </div>
</div>





        <?php

        if(isset($_POST['submit'])){
           
                $qty=$_POST['qty'];
                $status = $_POST['status'];
                $customer_name=$_POST['customer_name'];
                $customer_email=$_POST['customer_email'];
                $customer_contact=$_POST['customer_contact'];
                $customer_address=$_POST['customer_address'];
                $total=$qty*$price;

                $sql="UPDATE `order` SET 
                quantity=$qty,
                status ='$status',
                customer_name='$customer_name',
                customer_email='$customer_email',
                customer_contact='$customer_contact',
                customer_address='$customer_address',
                total='$total'
                WHERE id= $id
                ";
                $result=mysqli_query($connect,$sql);
                if($result){
                    $_SESSION["update-order"]= "<div class='success'>Order Updated Successfully</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                }
                else{
                    $_SESSION["update-order"]= "<div class='error'>Failed To updated order</div>";
                    header("location:".SITEURL."admin/manage-order.php");
                }
        }



        ?>







<?php require_once("partials/footer.php")?>