<?php
include("inc_functions.php");

if(isset($_POST['chkquantity'])){
    $quantity = $_POST['quantity'];
    $orderid = $_POST['orderid'];
    $cost = $_POST['cost'];
    mysqli_query($conn, "UPDATE tbl_order SET  order_quantity='$quantity',cost='$cost' WHERE order_id='$orderid'");
}
?>