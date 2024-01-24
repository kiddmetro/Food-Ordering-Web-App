<?php
require_once("../config/db.php");

if(isset($_POST['delete_order']))
{
    $id = mysqli_real_escape_string($db, $_POST['delete_order']);

    $query = "DELETE FROM orders WHERE order_id='$id' ";
    $query_run = mysqli_query($db, $query);

    if($query_run)
    {
        $_SESSION['message'] = "order Deleted Successfully";
        header("Location: orderindex.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "order Not Deleted";
        header("Location: orderindex.php");
        exit(0);
    }
}
if(isset($_POST['confirm-order'])) {
    $id = mysqli_real_escape_string($db, $_POST['id']);
    $isConfirmed = mysqli_real_escape_string($db, $_POST['is_confirmed']);

    $query = "UPDATE orders SET is_confirmed = '$isConfirmed' WHERE order_id = '$id'";
    $query_run = mysqli_query($db, $query);

    if($query_run) {
        $_SESSION['message'] = "Order confirmed successfully!";
        header("Location: orderindex.php");
    } else {
        $_SESSION['message'] = "Failed to confirm order!";
        header("Location: orderindex.php");
    }
}



?>