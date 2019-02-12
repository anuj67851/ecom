<h1 class="text-center">Security Question</h1>
<h6 style="color: red;" class="text-center"><?php display_message(); ?></h6>
<div class="col-sm-4 col-sm-offset-5">
    <form class="" action="" method="post" enctype="multipart/form-data">

        <?php security_question(); ?>

        <div class="form-group"><label for="answer">
                Answer<input type="text" name="answer" class="form-control" required></label>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
</div>