<h1 class="text-center">Login</h1>
<h6 style="color: red;" class="text-center"><?php display_message(); ?></h6>
<div class="col-sm-4 col-sm-offset-5">
    <form class="" action="" method="post" enctype="multipart/form-data">

        <?php login_user(); ?>
        <div class="form-group"><label for="">
                username<input type="text" name="username" class="form-control"></label>
        </div>
        <div class="form-group"><label for="password">
                Password<input type="password" name="password" class="form-control"></label>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" class="btn btn-primary"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="login.php?forgot_password">Forgot password</a>
        </div>
    </form>
</div>