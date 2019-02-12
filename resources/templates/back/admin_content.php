<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
            <small>Statistics Overview</small>

            <div class="pull-right">
                Net Income
                <small>&#36;<?php get_net_income(); ?></small>
            </div>
        </h1>
    </div>
</div>
<!-- /.row -->
<!-- FIRST ROW WITH PANELS -->

<!-- /.row -->
<div class="row">

    <div class="col-lg-4 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php get_order_count(); ?></div>
                        <div>Total Orders!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?orders">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-lg-4 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-support fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php get_products_count(); ?></div>
                        <div>Products!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?products">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


    <div class="col-lg-4 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php get_categories_count(); ?></div>
                        <div>Categories!</div>
                    </div>
                </div>
            </div>
            <a href="index.php?categories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>


</div>

<!-- /.row -->


<!-- SECOND ROW WITH TABLES-->

<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Orders Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Transaction #</th>
                            <th>Status</th>
                            <th>Amount (USD)</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php order_panel(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?orders">View All Orders <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Reports Panel</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                        <tr>
                            <th>Report #</th>
                            <th>Order #</th>
                            <th>Product Title</th>
                            <th>Amount (USD)</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php report_panel(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?reports">View All Reports <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->