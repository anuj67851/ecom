<?php add_product(); ?>
<div id="page-wrapper">

    <div class="container-fluid">


        <div class="col-md-12">

            <div class="row">
                <h1 class="page-header">
                    Add Product

                </h1>
            </div>


            <form action="" method="post" enctype="multipart/form-data">


                <div class="col-md-8">

                    <div class="form-group">
                        <label for="product-title">Product Title </label>
                        <input type="text" name="product_title" class="form-control" required>

                    </div>


                    <div class="form-group">
                        <label for="product-title">Product Description</label>
                        <textarea name="product_description" id="" cols="30" rows="10" class="form-control" required></textarea>
                    </div>


                    <div class="form-group row">

                        <div class="col-xs-3">
                            <label for="product-price">Product Price</label>
                            <input type="number" name="product_price" class="form-control" size="60" required>
                        </div>

                        <div class="col-xs-3">
                            <label for="product-quantity">Product Quantity</label>
                            <input type="number" name="product_quantity" class="form-control" size="60" step="1" required>
                        </div>
                    </div>


                </div><!--Main Content-->


                <!-- SIDEBAR-->


                <aside id="admin_sidebar" class="col-md-4">


                    <!-- Product Categories-->

                    <div class="form-group">
                        <label for="product-title">Product Category</label>
                        <select name="product_category_id" class="form-control" required>
                            <option value="">Select Category</option>
                            <?php  display_categories_in_dropdown(); ?>

                        </select>


                    </div>

                    <hr>
                    <!-- Product Brands-->



                    <div class="form-group">
                        <label for="product-brand">Product Brand </label>
                        <input type="text" name="product_brand" class="form-control" required>

                    </div>


                    <!-- Product Tags -->
                    <hr>

                    <div class="form-group">
                        <label for="product-title">Short Description</label>
                        <input type="text" name="product_short_desc" class="form-control" required>
                    </div>

                    <!-- Product Image -->

                    <div class="form-group">
                        <label for="product-title">Product Image Link</label>
                        <input type="text" name="file" class="form-control" required>

                    </div>

                    <hr>

                    <div class="form-group">
                        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
                    </div>


                </aside><!--SIDEBAR-->


            </form>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

