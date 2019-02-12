<?php

require_once("../../config.php");

if (isset($_GET['id'])){
    $query = query("Delete from categories where cat_id = ". escape_string($_GET['id']));
    confirm($query);

    redirect("../../../public/admin/index.php?categories");
} else{
    redirect("../../../public/admin/index.php?categories");
}