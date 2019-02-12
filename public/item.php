<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>
    <!-- Page Content -->
    <div class="container">

        <!-- Side Navigation -->
        <?php include(TEMPLATE_FRONT . DS . "side_nav.php"); ?>
        <h4 style="color: red;" class="text-center"><?php display_message(); ?></h4>

        <?php


        $query = query(" SELECT * FROM products WHERE product_id = " . escape_string($_GET['id']) . " ");
        confirm($query);

        while($row = fetch_array($query)):

            ?>

        <div class="col-md-9">

            <!--Row For Image and Short Description-->

            <div class="row">

                <div class="col-md-7">
                    <img class="img-responsive" src="<?php echo $row['product_image'] ?>" alt="">

                </div>

                <div class="col-md-5">

                    <div class="thumbnail">


                        <div class="caption-full">
                            <h4><?php echo $row['product_title']; ?></h4>
                            <h6><?php echo $row['brand']; ?></h6>

                            <h4 class="">&#36;<?php echo $row['product_price']; ?></h4>

                            <div class="ratings">
                                <p>
                                    <?php get_avg_rating(); ?>
                                </p>
                            </div>

                            <p><?php echo $row['short_desc']; ?></p>


                            <form action="">
                                <div class="form-group">
                                    <?php
                                    $quantity = $row['product_quantity'];
                                    if ($quantity > 0 )
                                    {
                                        $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Add to Cart</a>
delimeter;
                                    }
                                    else{
                                        $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}" disabled>Out Of Stock</a>
delimeter;
                                    }

                                    echo $button;
                                    ?>
                                </div>
                            </form>

                        </div>

                    </div>

                </div>


            </div><!--Row For Image and Short Description-->


            <hr>


            <!--Row for Tab Panel-->

            <div class="row">

                <div role="tabpanel">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab"
                                                                  data-toggle="tab">Description</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a>
                        </li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home">

                            <p></p>

                            <p><?php echo $row['product_description']; endwhile; ?></p>

                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">

                            <div class="col-md-6">
                                <?php get_ratings(); ?>
                            </div>


                            <div class="col-md-6">
                                <h3>Add A review</h3>

                                <form class="form-inline" method="post">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input name="name" type="text" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" name="email" class="form-control" required>
                                    </div>

                                    <div>
                                        <label for="">Your Rating</label>
                                        <input type="number" name="stars" class="form-control" required max="5" min="1" step="0.01">
                                    </div>

                                    <br>

                                    <div class="form-group">
                                        <textarea name="description" id="" cols="60" rows="10" class="form-control" placeholder="Write a review !"></textarea>
                                    </div>

                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="SUBMIT" name="submit_review">
                                    </div>
                                </form>
                                <?php if (isset($_POST['submit_review'])) { add_review(); } ?>

                            </div>

                        </div>

                    </div>

                </div>


            </div><!--Row for Tab Panel-->


        </div>
        <?php //endwhile; ?>

    </div>
    <!-- /.container -->
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>