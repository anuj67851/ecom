<?php update_product(); ?>
<?php

if (isset($_GET['id']))
{
    $query = query("Select * from products where product_id = ".escape_string($_GET['id']));
    confirm($query);

    $row = fetch_array($query);
}

?>
<div id="page-wrapper">

    <div class="container-fluid">


        <div class="col-md-12">

            <div class="row">
                <h1 class="page-header">
                    Edit Product

                </h1>
            </div>


            <form action="" method="post" enctype="multipart/form-data">


                <div class="col-md-8">

                    <div class="form-group">
                        <label for="product-title">Product Title </label>
                        <input type="text" value="<?php echo $row['product_title']; ?>" name="product_title" class="form-control" required>

                    </div>


                    <div class="form-group">
                        <label for="product-title">Product Description</label>
                        <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required><?php echo $row['product_description']; ?></textarea>
                    </div>


                    <div class="form-group row">

                        <div class="col-xs-3">
                            <label for="product-price">Product Price</label>
                            <input type="number" value="<?php echo $row['product_price']; ?>" name="product_price" class="form-control" size="60" required>
                        </div>

                        <div class="col-xs-3">
                            <label for="product-quantity">Product Quantity</label>
                            <input type="number" value="<?php echo $row['product_quantity']; ?>" name="product_quantity" class="form-control" size="60" step="1" required>
                        </div>
                    </div>


                </div><!--Main Content-->


                <!-- SIDEBAR-->


                <aside id="admin_sidebar" class="col-md-4">


                    <!-- Product Categories-->

                    <div class="form-group">
                        <label for="product-title">Product Category</label>
                        <select name="product_category_id" class="form-control" required>
                            <optgroup label="Current Category"></optgroup>
                            <option value="<?php echo $row['product_category_id']; ?>"><?php find_category_title($row['product_category_id']); ?></option>
                            <optgroup label="Available Categories"></optgroup>
                            <?php  display_categories_in_dropdown(); ?>

                        </select>


                    </div>

                    <hr>
                    <!-- Product Brands-->



                    <div class="form-group">
                        <label for="product-brand">Product Brand </label>
                        <input type="text" value="<?php echo $row['brand']; ?>" name="product_brand" class="form-control" required>

                    </div>


                    <!-- Product Tags -->
                    <hr>

                    <div class="form-group">
                        <label for="product-title">Short Description</label>
                        <input type="text" value="<?php echo $row['short_desc']; ?>" name="product_short_desc" class="form-control" required>
                    </div>

                    <!-- Product Image -->

                    <div class="form-group">
                        <label for="product-title">Product Image Link</label>
                        <input type="text" name="file" value="<?php echo $row['product_image']; ?>" class="form-control" required>

                    </div>
                    <img style="width: 150px;" src="<?php echo $row['product_image']?>">

                    <hr>

                    <div class="form-group ">
                        <input type="submit" name="update" class="btn btn-primary btn-lg" value="Update">
                    </div>


                </aside><!--SIDEBAR-->


            </form>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

