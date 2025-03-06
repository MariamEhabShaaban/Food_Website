<?php require 'partials/menu.php'; ?>
<div class="main-content">
    <div class="warpper">
        <h1>Manage Order</h1>
        <br><br>
        <?php
            if(isset( $_SESSION['no-order-found'])){
                echo  $_SESSION['no-order-found'];
                unset( $_SESSION['no-order-found']);
            }
            if(isset( $_SESSION["update-order"])){
                echo  $_SESSION["update-order"];
                unset( $_SESSION["update-order"]);
            }


        ?>
        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order Date</th>
                <th>Status</th>
                <th>Customer Name</th>
                <th>Customer Contact</th>
                <th>Customer Email</th>
                <th>Customer Address</th>
                <th>Actions</th>


            </tr>
            <?php
               $sql="SELECT * FROM `order`";
               $result=mysqli_query($connect,$sql);
               $count=mysqli_num_rows($result);
               if($count> 0){
                $cnt=1;
                while($row=mysqli_fetch_array($result)){
               
                $id=$row['id'];
                $food=$row['food'];
                $price=$row['price'];
                $qty=$row['quantity'];
                $total=$row['total'];
                $order_date= $row['date'];
                $status = $row['status']; // ordered , on delivery, delivered , cancelled
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];


                
                
                
                ?>
            <tr>
                <td><?php echo $cnt++?></td>
                <td><?php echo $food?></td>
                <td>$<?php echo $price?></td>
                <td><?php echo $qty?></td>
                <td>$<?php echo $total?></td>
               
                <td><?php echo $order_date?></td>
                <td>
                <?php
                
                if($status=="Ordered"){
                    echo "<label>$status</label>";
                }
                elseif($status== "On Delivery"){
                    echo "<label style='color : orange;'>$status</label>";
                }
                elseif($status== "Delivered"){
                    echo "<label style='color : green;'>$status</label>";
                }
                elseif($status== "Cancelled"){
                    echo "<label style='color : red;'>$status</label>";
                }
                
                ?>

                </td>
                
                <td><?php echo $customer_name?></td>
                <td><?php echo $customer_contact?></td>
                <td><?php echo $customer_email ?></td>
                <td><?php echo $customer_address ?></td>
                

                <td> <a href="update-order.php?id=<?php echo $id?>" class="btn-secondary">Update</a></td>
            </tr>
            <?php 
            }
        }else {
                echo "<div class= 'error text-center'>No Orders Yet</div>";
            }
            ?>
            
        </table>

    </div>
</div>




<?php require 'partials/footer.php'; ?>