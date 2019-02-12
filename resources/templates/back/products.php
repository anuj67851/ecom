<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">

            <h1 class="page-header">
                All Products
                <div class="pull-right">
                    Total Products :
                    <?php get_total_products(); ?>
                </div>
            </h1>
            <h4 class="success"><?php display_message(); ?></h4>
            <table class="table table-hover">


                <thead>

                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
                </thead>
                <tbody>
                <?php get_products_in_admin(); ?>
                </tbody>
            </table>


        </div>

    </div>
    <!-- /.container-fluid -->

