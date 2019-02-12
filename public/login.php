<?php require_once("../resources/config.php"); ?>
<?php include (TEMPLATE_FRONT. DS . "header.php"); ?>

<!-- Page Content -->
<div class="container">

    <header>

        <?php
        if ($_SERVER['REQUEST_URI'] == "/ecom/public/login.php") {
            include(TEMPLATE_FRONT . "/login.php");
        }

        if (isset($_GET['forgot_password'])) {
            include(TEMPLATE_FRONT . "/forgot_password.php");
        }

        if (isset($_GET['security_question'])) {
            include(TEMPLATE_FRONT . "/security_ques.php");
        }

        if (isset($_GET['new_password'])) {
            include(TEMPLATE_FRONT . "/new_password.php");
        }

        ?>

    </header>


</div>

<!-- /.container -->

<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>

