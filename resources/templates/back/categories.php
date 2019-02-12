<?php add_category(); ?>
<div id="page-wrapper">

    <div class="container-fluid">


        <h1 class="page-header">
            Product Categories
            <div class="pull-right">
                Total Categories :
                <?php get_total_categories(); ?>
            </div>
        </h1>
        <h4><?php display_message(); ?></h4>


        <div class="col-md-4">

            <form action="" method="post">

                <div class="form-group">
                    <label for="category-title">Title</label>
                    <input type="text" class="form-control" name="cat_title" required>
                </div>
                <div class="form-group">
                    <label for="product-title">Category Description</label>
                    <input type="text" name="cat_desc" id="" class="form-control" required>
                </div>

                <div class="form-group">

                    <input name="submit" type="submit" class="btn btn-primary" value="Add Category">
                </div>


            </form>


        </div>


        <div class="col-md-8">

            <table class="table">
                <thead>

                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
                </thead>


                <tbody>
                <?php display_categories_in_admin(); ?>
                </tbody>

            </table>

        </div>


    </div>
    <!-- /.container-fluid -->

