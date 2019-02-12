<div class="col-md-12">
    <div class="row">
        <h1 class="page-header">
            All Reports
            <div class="pull-right">
                Products Sold :
                <?php get_products_sold(); ?>
            </div>
        </h1>
    </div>

    <div class="row">
        <table class="table table-hover">
            <thead>

            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Order Id</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            </thead>
            <tbody>
            <?php display_reports(); ?>
            </tbody>
        </table>
    </div>


