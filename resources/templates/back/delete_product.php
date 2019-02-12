<?php

require_once("../../config.php");

if (isset($_GET['id'])){
    $query = query("Delete from products where product_id = ". escape_string($_GET['id']));
    confirm($query);

    $query = query("Delete from reviews where product_id = ". escape_string($_GET['id']));
    confirm($query);

    redirect("../../../public/admin/index.php?products");
} else{
    redirect("../../../public/admin/index.php?products");
}