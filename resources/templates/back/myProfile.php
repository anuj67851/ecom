<?php update_profile(); ?>
<?php

if (isset($_SESSION['username'])) {

    $query = query("SELECT * FROM `users` WHERE `username` = '{$_SESSION['username']}'");
    confirm($query);

    $row = fetch_array($query);
}

?>
<div id="page-wrapper">

    <div class="container-fluid">


        <div class="col-md-12">

            <div class="row">
                <h1 class="page-header">
                    User Profile

                </h1>

                <h4><?php display_message(); ?></h4>
            </div>


            <form action="" method="post" enctype="multipart/form-data">


                <div class="col-md-8">

                    <div class="form-group row">
                        <div class="col-xs-3">
                            <label for="product-price">First Name</label>
                            <input type="text" value="<?php echo $row['first']; ?>" name="first" class="form-control" size="60" required>
                        </div>

                        <div class="col-xs-3">
                            <label for="product-quantity">Last Name</label>
                            <input type="text" value="<?php echo $row['last']; ?>" name="last" class="form-control" size="60" step="1" required>
                        </div>
                    </div>

                    <div>
                        <label for="user-name">User Name </label>
                        <input type="text" value="<?php echo $row['username']; ?>" name="username" class="form-control"
                               required><br>
                    </div>

                    <div>
                        <label for="product-price">Email</label>
                        <input type="email" value="<?php echo $row['email']; ?>" name="email"
                               class="form-control" size="60" required><br>
                    </div>

                    <div>
                        <label for="product-price">Password</label>
                        <input type="password" value="<?php echo $row['password']; ?>" name="password"
                               class="form-control" size="60" required><br>
                    </div>

                    <div>
                        <label for="product-quantity">Security Question</label>
                        <input type="text" value="<?php echo $row['security_question']; ?>" name="security_question"
                               class="form-control"required>
                    </div>

                    <div>
                        <label for="product-quantity">Answer</label>
                        <input type="text" value="<?php echo $row['answer']; ?>" name="answer"
                               class="form-control"required><br>
                    </div>

                    <br>
                    <div class="form-group ">
                        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
                    </div>



                </div><!--Main Content-->



            </form>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

