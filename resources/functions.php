<?php

//helper functions
function set_message($msg)
{
    if (!empty($msg)) {
        $_SESSION['message'] = $msg;
    } else {
        $msg = "";
    }
}

function display_message()
{
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}


function redirect($location)
{
    header("Location: $location");
}

function query($sql)
{
    global $connection;
    return mysqli_query($connection, $sql);
}

function confirm($result)
{
    global $connection;

    if (!$result) {
        die("QUERY FAILED " . mysqli_error($connection));
    }
}

function escape_string($string)
{
    global $connection;

    return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result)
{
    return mysqli_fetch_array($result);
}

//-----------------------------FRONT END------------------------------------//
//get products

function get_products()
{

    $query = query("select * from products");
    confirm($query);

    while ($row = fetch_array($query)) {

        $average = query("select avg(stars) from reviews where product_id = " . $row['product_id']);
        confirm($average);
        $avg_rating = fetch_array($average);
        $ans = number_format((float)$avg_rating['avg(stars)'], 1, '.', '');
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

        $product = <<<DELIMETER
<div class="col-sm-4 col-lg-4 col-md-4">
    <div class="thumbnail">
        <a href="item.php?id={$row['product_id']}"><img src="{$row['product_image']}" alt=""></a>
        <div class="caption">
            <h4 class="pull-right">&#36;{$row['product_price']}</h4>
            <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
            </h4>
            <p>{$row['short_desc']}</p>
           {$button}
              <span class="glyphicon glyphicon-star pull-right ratings"></span><span class="pull-right" style="color: #d17581;">{$ans}</span>
        </div>
    </div>
</div>

DELIMETER;

        echo $product;
    }

}

//get categories

function get_categories()
{

    $query = query("select * from categories");
    confirm($query);

    while ($row = fetch_array($query)) {
        echo "<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>";
    }

}


function get_category_desc()
{
    $query = query("select cat_desc from categories where cat_id = " . escape_string($_GET['id']));
    confirm($query);
    $row = fetch_array($query);
    echo $row['cat_desc'];
}

function get_category_products()
{
    $query = query("select * from products where product_category_id = " . escape_string($_GET['id']));
    confirm($query);

    while ($row = fetch_array($query)) {
        $quantity = $row['product_quantity'];
        if ($quantity > 0 )
        {
            $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Buy Now!</a>
delimeter;
        }
        else{
            $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}" disabled>Out Of Stock</a>
delimeter;
        }

        $product = <<<DELIMETER

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            {$button}
                             <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

        echo $product;
    }

}


function get_products_shop_page()
{
    $query = query("select * from products");
    confirm($query);

    while ($row = fetch_array($query)) {
        $quantity = $row['product_quantity'];
        if ($quantity > 0 )
        {
            $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}">Buy Now!</a>
delimeter;
        }
        else{
            $button = <<<delimeter
<a class="btn btn-primary" target="_blank" href="../resources/cart.php?add={$row['product_id']}" disabled>Out Of Stock</a>
delimeter;
        }

        $product = <<<DELIMETER

            <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['short_desc']}</p>
                        <p>
                            {$button} <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

DELIMETER;

        echo $product;
    }
}


function login_user()
{
    if (isset($_POST['submit'])) {
        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("Select * from users where username = '{$username}' and password = '{$password}' ");
        confirm($query);

        if (mysqli_num_rows($query) == 0) {
            set_message("Your username or password are incorrect.");
            redirect("login.php");
        } else {
            $_SESSION['username'] = $username;
            redirect("admin");
        }

    }
}

function forgot_password(){
    if (isset($_POST['submit'])){
        $username = escape_string($_POST['username']);

        $query = query("Select * from users where username = '{$username}'");
        confirm($query);

        if (mysqli_num_rows($query) == 0){
            set_message("Username does not Exist");
            redirect("login.php?forgot_password");
        }
        else{
            $_SESSION['username_to_recover'] = $username;
            redirect("login.php?security_question");
        }
    }
}

function security_question(){

    $username = $_SESSION['username_to_recover'];
    $query = query("Select * from users where username = '{$username}'");
    confirm($query);
    $row = fetch_array($query);
    $ques = $row['security_question'];

    $question = <<<Delimeter
<div class="form-group"><label for="">
        Question<input type="text" name="Question" class="form-control" value="{$ques}" disabled></label>
</div>
Delimeter;

    echo $question;


    if (isset($_POST['submit'])){
        $answer = $_POST['answer'];
        if ($row['answer'] == $answer){
            redirect("login.php?new_password");
        }
        else{
            set_message("Incorrect Answer");
        }
    }
}

function reset_password(){
    if (isset($_POST['submit']))
    {
        $password = $_POST['password'];
        $cpassword = $_POST['confirm_password'];

        if ($password == $cpassword)
        {
            $query = query("Update users set password = '{$password}' where username = '{$_SESSION['username_to_recover']}'");
            confirm($query);

            unset($_SESSION['username_to_recover']);
            set_message("Password Reset SuccessFully");
            redirect("login.php");
        }
        else{
            set_message("Passwords does not match");
        }
    }
}

function send_message()
{
    if (isset($_POST['submit'])) {

        $to = "anujpatel6785@gmail.com";
        $from_name = $_POST['name'];
        $subject = $_POST['subject'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $result = mail($to, $subject, $message . "\n\n\nFrom: {$from_name} \nEmail:{$email} \nSent via Ecom Contact");

        if (!$result) {
            set_message("Sorry We could not send your message");
            redirect("contact.php");
        } else {
            set_message("Your message has been sent");
            redirect("contact.php");
        }
    }
}

function get_ratings()
{

    $query = query("select * from reviews where product_id = " . escape_string($_GET['id']));
    confirm($query);


    $count = mysqli_num_rows($query);

    if ($count == 0) {
        $abc = <<<delimeter
             <h3>No Reviews yet !</h3>
delimeter;

        echo $abc;

    } else {
        $review = <<<deli
        <h3>{$count} Reviews From </h3>
deli;

        echo $review;

        while ($row = fetch_array($query)) {

//            $diff = abs(strtotime(date('Y-m-d')) - strtotime($row['date']));
//            $diff->format("%R%a days");
            $product = <<<Delimeter
    
<hr>   
<div class="row">
    <div class="col-md-12">
        <span class="">{$row['stars']}</span>
        <span class="glyphicon glyphicon-star"></span>
    {$row['name']}<span class="pull-right">{$row['date']}</span>
        <p>{$row['description']}</p>
    </div>
</div>
Delimeter;

            echo $product;
        }
    }
}

function get_avg_rating()
{
    $query = query("select * from reviews where product_id = " . escape_string($_GET['id']));
    confirm($query);


    $count = mysqli_num_rows($query);

    if ($count == 0) {
        $abc = <<<delimeter
             <h3>No Ratings yet !</h3>
delimeter;

        echo $abc;

    } else {

        $query = query("select avg(stars) from reviews where product_id = " . escape_string($_GET['id']));
        confirm($query);
        $avg_rating = fetch_array($query);
        $ans = number_format((float)$avg_rating['avg(stars)'], 1, '.', '');
        $review = <<<deli
        <h4>{$ans} <span class="glyphicon glyphicon-star"></span></h4>
deli;

        echo $review;

    }
}


function add_review()
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $stars = $_POST['stars'];
    if (isset($_POST['description'])) {
        $description = $_POST['description'];
    } else {
        $description = "";
    }
    $product_id = $_GET['id'];

    $Sql_Query = "INSERT INTO reviews(product_id, name, email, stars, description, date) VALUES ('$product_id','$name','$email','$stars','$description',CURRENT_DATE )";
    $query = query($Sql_Query);


    if ($query) {
        $msg = "Review submitted successfully";
    } else {
        $msg = "Review submission unsuccessful ";
    }
    set_message($msg);
    redirect("item.php?id={$_GET['id']}");
}


//---------------------------Admin Functions --------------------//


function display_orders()
{

    $query = query("Select * from orders");
    confirm($query);

    while ($row = fetch_array($query)) {
        $orders = <<<Delimeter
<tr>
    <td>{$row['order_id']}</td>
    <td>&#36;{$row['order_amount']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_currency']}</td>
    <td>{$row['order_status']}</td>
    <td><a href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
Delimeter;

        echo $orders;

    }

}

//------------------------ADMIN PRODUCTS-----------------------/

function get_products_in_admin()
{
    $query = query("Select * from products");
    confirm($query);

    while ($row = fetch_array($query)) {
        $find_cat = query("Select cat_title from categories where cat_id = " . escape_string($row['product_category_id']));
        confirm($find_cat);
        $category = fetch_array($find_cat);

        $orders = <<<Delimeter
<tr>
    <td>{$row['product_id']}</td>
    <td>{$row['product_title']}</td>
    <td><img width="100" src="{$row['product_image']}" alt=""></td>
    <td>{$category['cat_title']}</td>
    <td>{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
    <td><a href="index.php?edit_product&id={$row['product_id']}"><span class="glyphicon glyphicon-edit"></span></a></td>
    <td><a href="../../resources/templates/back/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
Delimeter;

        echo $orders;

    }
}

function display_categories_in_dropdown(){
    $query = query("select * from categories");
    confirm($query);

    while ($row = fetch_array($query)){
        $dropdown = <<<delimeter
        <option value="{$row['cat_id']}">{$row['cat_title']}</option>
delimeter;

        echo $dropdown;

    }
}

function add_product()
{
   if (isset($_POST['publish'])){

       $product_title = escape_string($_POST['product_title']);
       $product_category_id = $_POST['product_category_id'];
       $product_price = escape_string($_POST['product_price']);
       $product_description = escape_string($_POST['product_description']);
       $short_desc = escape_string($_POST['product_short_desc']);
       $product_quantity = escape_string($_POST['product_quantity']);
       $brand = escape_string($_POST['product_brand']);
       $product_image = $_POST['file'];

       $query = query("insert into products(product_title, product_category_id, product_price, product_description, short_desc, product_quantity, product_image, brand) values ('{$product_title}', '{$product_category_id}', '{$product_price}', '{$product_description}', '{$short_desc}', '{$product_quantity}', '{$product_image}', '{$brand}')");
       confirm($query);
       set_message("New product Added");
       redirect("index.php?products");
   }
}

function update_product()
{
    if (isset($_POST['update'])){

        $product_title = escape_string($_POST['product_title']);
        $product_category_id = $_POST['product_category_id'];
        $product_price = escape_string($_POST['product_price']);
        $product_description = escape_string($_POST['product_description']);
        $short_desc = escape_string($_POST['product_short_desc']);
        $product_quantity = escape_string($_POST['product_quantity']);
        $brand = escape_string($_POST['product_brand']);
        $product_image = $_POST['file'];

        $query = "UPDATE `products` SET `product_title`='{$product_title}',`product_category_id`='{$product_category_id}',`product_price`='{$product_price}',`product_quantity`='{$product_quantity}',`product_description`='{$product_description}',`product_image`='{$product_image}',`short_desc`='{$short_desc}',`brand`='{$brand}' WHERE `product_id` = ".escape_string($_GET['id']);

        $send_update_query = query($query);
        confirm($send_update_query);
        set_message("Product has been updated");
        redirect("index.php?products");
    }
}


function find_category_title($id){
    $query = query("select * from categories where cat_id = {$id}");
    confirm($query);

    $row=fetch_array($query);
    echo $row['cat_title'];

}

function update_profile(){

    if (isset($_POST['update'])){
        $verify = "select * from `users` where `username` = '{$_SESSION['username']}'";
        $verify = query($verify);
        confirm($verify);

        $row=fetch_array($verify);
        $user_id_number = $row['user_id'];

        $username = $_POST['username'];
        $email = $_POST['email'];

        $verify = "select * from `users` where (`username` = '{$username}' or `email` = '{$email}') and not `user_id` = '{$user_id_number}'";
        $verify = query($verify);
        confirm($verify);
        if (mysqli_num_rows($verify) > 0){
            set_message("Username Or Email is already in use");
        }
        else{
            $first = $_POST['first'];
            $last = $_POST['last'];
            $password = $_POST['password'];
            $security_question = $_POST['security_question'];
            $answer = $_POST['answer'];

            $query = query("UPDATE `users` SET `username`='{$username}',`first`='{$first}',`last`='{$last}',`email`='{$email}',`password`='{$password}',`security_question`='{$security_question}',`answer`='{$answer}' WHERE `username` = '{$_SESSION['username']}'");
            confirm($query);

            set_message("Profile Updated Successfully");
            $_SESSION['username'] = $username;
        }

    }
}


function display_categories_in_admin(){
    $query = query("select * from `categories`");
    confirm($query);

    while ($row = fetch_array($query)){
        $category = <<<delimeter
<tr>
    <td>{$row['cat_id']}</td>
    <td>{$row['cat_title']}</td>
    <td>{$row['cat_desc']}</td>
    <td><a href="../../resources/templates/back/delete_category.php?id={$row['cat_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
delimeter;

        echo $category;

    }
}

function add_category(){
    if (isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        $cat_desc = $_POST['cat_desc'];

        $verify = "select * from `categories` where `cat_title` = '{$cat_title}'";
        $verify = query($verify);
        confirm($verify);
        if (mysqli_num_rows($verify) > 0){
            set_message("Title is already in use");
        }
        else{

            $query = query("INSERT INTO `categories`(`cat_title`, `cat_desc`) VALUES ('{$cat_title}','{$cat_desc}')");
            confirm($query);

            set_message("Category Added Successfully");
        }
    }
}

function display_users(){
    $query = query("Select * from users");
    confirm($query);

    while ($row = fetch_array($query))
    {
        $ans = <<<delimeter
<tr>
    <td>{$row['user_id']}</td>
    <td>{$row['username']}</td>
    <td>{$row['first']}</td>
    <td>{$row['last']}</td>
    <td>{$row['email']}</td>
    <td><a href="../../resources/templates/back/delete_user.php?id={$row['user_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
delimeter;

        echo $ans;

    }
}

function add_user(){

    if (isset($_POST['add'])){

        $username = $_POST['username'];
        $email = $_POST['email'];

        $verify = "select * from `users` where `username` = '{$username}' or `email` = '{$email}'";
        $verify = query($verify);
        confirm($verify);
        if (mysqli_num_rows($verify) > 0){
            set_message("Username Or Email is already in use");
        }
        else{
            $first = $_POST['first'];
            $last = $_POST['last'];
            $password = $_POST['password'];
            $security_question = $_POST['security_question'];
            $answer = $_POST['answer'];

            $query = query("INSERT INTO `users`(`username`, `first`, `last`, `email`, `password`, `security_question`, `answer`) VALUES ('{$username}','{$first}','{$last}','{$email}','{$password}','{$security_question}','{$answer}')");
            confirm($query);

            set_message("User Added Successfully");
            redirect("index.php?users");
        }

    }
}


function display_reports(){
    $query = query("Select * from reports");
    confirm($query);

    while ($row = fetch_array($query)) {
        $find_product = query("Select product_title from products where product_id = " . escape_string($row['product_id']));
        confirm($find_product);
        $title = fetch_array($find_product);

        $orders = <<<Delimeter
<tr>
    <td>{$row['report_id']}</td>
    <td>{$title['product_title']}</td>
    <td>{$row['order_id']}</td>
    <td>&#36;{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
    <td><a href="../../resources/templates/back/delete_report.php?id={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a></td>
</tr>
Delimeter;

        echo $orders;

    }
}


//------------------admin page----------------------//

function get_order_count(){
    $query = query("Select count(order_id) from orders");
    confirm($query);
    $row = fetch_array($query);
    echo $row['count(order_id)'];
}

function get_products_count(){
    $query = query("Select count(product_id) from products");
    confirm($query);
    $row = fetch_array($query);
    echo $row['count(product_id)'];
}

function get_categories_count(){
    $query = query("Select count(cat_id) from categories");
    confirm($query);
    $row = fetch_array($query);
    echo $row['count(cat_id)'];
}

function order_panel(){
    $counter = 0;
    $query = query("Select * from orders order by order_id desc");
    confirm($query);
    while ($counter<8 and $row = fetch_array($query)){
        $print = <<<delimeter
<tr>
    <td>{$row['order_id']}</td>
    <td>{$row['order_transaction']}</td>
    <td>{$row['order_status']}</td>
    <td>&#36;{$row['order_amount']}</td>
</tr>
delimeter;
        echo $print;

        $counter++;
    }


}


function report_panel(){
    $counter = 0;
    $query = query("Select * from reports order by report_id desc");
    confirm($query);
    while ($counter<8 and $row = fetch_array($query)){
        $find_product = query("Select product_title from products where product_id = " . escape_string($row['product_id']));
        confirm($find_product);
        $title = fetch_array($find_product);

        $print = <<<delimeter
<tr>
    <td>{$row['report_id']}</td>
    <td>{$row['order_id']}</td>
    <td>{$title['product_title']}</td>
    <td>&#36;{$row['product_price']}</td>
    <td>{$row['product_quantity']}</td>
</tr>
delimeter;
        echo $print;

        $counter++;
    }


}


function get_net_income(){

    $query = query("Select sum(order_amount) from orders");
    confirm($query);

    $row = fetch_array($query);
    $row['sum(order_amount)']=number_format((float)$row['sum(order_amount)'], 2, '.', '');
    echo $row['sum(order_amount)'];
}

function get_products_sold(){
    $query = query("Select sum(product_quantity) from reports");
    confirm($query);

    $row = fetch_array($query);
    echo $row['sum(product_quantity)'];
}

function get_total_products(){
    $query = query("Select count(*) from products");
    confirm($query);

    $row = fetch_array($query);
    echo $row['count(*)'];
}

function get_total_categories(){
    $query = query("Select count(*) from categories");
    confirm($query);

    $row = fetch_array($query);
    echo $row['count(*)'];
}

function get_total_users(){
    $query = query("Select count(*) from users");
    confirm($query);

    $row = fetch_array($query);
    echo $row['count(*)'];
}