<?php add_user(); ?>

<div id="page-wrapper">

    <div class="container-fluid">


        <div class="col-md-12">

            <div class="row">
                <h1 class="page-header">
                    Add User

                </h1>
                <h4><?php display_message(); ?></h4>
            </div>


            <form action="" method="post" enctype="multipart/form-data">


                <div class="col-md-8">

                    <div class="form-group row">
                        <div class="col-xs-3">
                            <label for="product-price">First Name</label>
                            <input type="text" name="first" class="form-control" size="60" required>
                        </div>

                        <div class="col-xs-3">
                            <label for="product-quantity">Last Name</label>
                            <input type="text" name="last" class="form-control" size="60" step="1" required>
                        </div>
                    </div>

                    <div>
                        <label for="user-name">User Name </label>
                        <input type="text" name="username" class="form-control"
                               required><br>
                    </div>

                    <div>
                        <label for="product-price">Email</label>
                        <input type="email" name="email"
                               class="form-control" size="60" required><br>
                    </div>

                    <div>
                        <label for="product-price">Password</label>
                        <input type="password" name="password"
                               class="form-control" size="60" required><br>
                    </div>

                    <div>
                        <label for="product-quantity">Security Question</label>
                        <input type="text" name="security_question"
                               class="form-control"required><br>
                    </div>

                    <div>
                        <label for="product-quantity">Answer</label>
                        <input type="text" name="answer"
                               class="form-control"required>
                    </div>

                    <br>
                    <div class="form-group ">
                        <input type="submit" name="add" class="btn btn-primary btn-lg" value="Add">
                    </div>



                </div><!--Main Content-->



            </form>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

