<?php require_once("../resources/config.php"); ?>
<?php require_once("../resources/cart.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<?php
    process_transaction();
    session_destroy();
?>

<!-- Page Content -->
<div class="container">

    <h1 class="text-center">THANK YOU</h1>

</div>
<!-- /.container -->


<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

