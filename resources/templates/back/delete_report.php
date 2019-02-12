<?php

require_once("../../config.php");

if (isset($_GET['id'])){
    $query = query("Delete from reports where report_id = ". escape_string($_GET['id']));
    confirm($query);

    redirect("../../../public/admin/index.php?reports");
} else{
    redirect("../../../public/admin/index.php?reports");
}