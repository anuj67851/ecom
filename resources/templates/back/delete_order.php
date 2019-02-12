<?php

require_once("../../config.php");

if (isset($_GET['id'])){
    $query = query("Delete from orders where order_id = ". escape_string($_GET['id']));
    confirm($query);

    redirect("../../../public/admin/index.php?orders");
} else{
    redirect("../../../public/admin/index.php?orders");
}