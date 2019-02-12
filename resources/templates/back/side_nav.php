<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">

        <li class="<?php if ($_SERVER['REQUEST_URI'] == "/ecom/public/admin/" || $_SERVER['REQUEST_URI'] == "/ecom/public/admin/index.php"){echo "active";} ?>">
            <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>

        <li class="<?php if (isset($_GET['orders'])) {echo 'active';} ?>">
            <a href="index.php?orders"><i class="fa fa-fw fa-database"></i> Orders</a>
        </li>

        <li class="<?php if (isset($_GET['reports'])) {echo 'active';} ?>">
            <a href="index.php?reports"><i class="fa fa-fw fa-reddit"></i> Reports</a>
        </li>

        <li class="<?php if (isset($_GET['products']) || isset($_GET['edit_product'])) {echo 'active';} ?>">
            <a href="index.php?products"><i class="fa fa-fw fa-bar-chart-o"></i> View Products</a>
        </li>
        <li class="<?php if (isset($_GET['add_product'])) {echo 'active';} ?>">
            <a href="index.php?add_product"><i class="fa fa-fw fa-table"></i> Add Product</a>
        </li>

        <li class="<?php if (isset($_GET['categories'])) {echo 'active';} ?>">
            <a href="index.php?categories"><i class="fa fa-fw fa-desktop"></i> Categories</a>
        </li>

        <li class="<?php if (isset($_GET['users']) || isset($_GET['add_user'])) {echo 'active';} ?>">
            <a href="index.php?users"><i class="fa fa-fw fa-wrench"></i>Users</a>
        </li>

    </ul>
</div>

