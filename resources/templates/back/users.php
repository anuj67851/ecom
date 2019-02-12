<div id="page-wrapper">

    <div class="container-fluid">


        <div class="col-lg-12">


            <h1 class="page-header">
                Users
                <div class="pull-right">
                    Total Users :
                    <?php get_total_users(); ?>
                </div>
            </h1>
            <p class="bg-success">
                <?php echo $message; ?>
            </p>

            <a href="index.php?add_user" class="btn btn-primary">Add User</a>


            <div class="col-md-12">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php display_users(); ?>

                    </tbody>
                </table> <!--End of Table-->


            </div>


        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

