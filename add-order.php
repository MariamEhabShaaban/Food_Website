<?php
require_once("config/constants.php");
if (isset($_POST['submit'])) {
    $food = $_POST['food'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];

    $total = $price * $qty;
    $order_date = date('Y-m-d h:i:sa');
    $status = "Ordered"; // ordered , on delivery, delivered , cancelled
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];


    // Save order in database
    $sql2 = "INSERT INTO `order` (`food`,`price`,`quantity`,`total`,`date`,`status`,`customer_name`,`customer_contact`,`customer_email`,`customer_address`) VALUES ('$food',$price,$qty,$total,'$order_date','$status','$customer_name','$customer_contact','$customer_email','$customer_address')
    ";
    $result2=mysqli_query($connect, $sql2);
    if ($result2) {

        $_SESSION['order']="<div class='success text-center'>Food Ordered Successfully</div>";
        header("location:".SITEURL);
    } else {
        $_SESSION['order']="<div class='error text-center'>Failed To Order Food</div>";
        header("location:".SITEURL);
    }







}

?>
