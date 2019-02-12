<?php require_once("config.php"); ?>

<?php

if (isset($_GET['add'])) {

    $query = query("select * from products where product_id = " . escape_string($_GET['add']));
    confirm($query);

    while ($row = fetch_array($query)) {
        if ($row['product_quantity'] != $_SESSION['product_' . $_GET['add']]) {
            $_SESSION['product_' . $_GET['add']] += 1;
            redirect("../public/checkout.php");
        } else {
            set_message("We only have " . $row['product_quantity'] . " of " . $row['product_title'] . " available");
            redirect("../public/checkout.php");
        }
    }

}

if (isset($_GET['remove'])) {
    $_SESSION['product_' . $_GET['remove']]--;

    if ($_SESSION['product_' . $_GET['remove']] < 1) {
        unset($_SESSION['product_' . $_GET['remove']]);
        redirect("../public/checkout.php");
    } else {
        redirect("../public/checkout.php");
    }
}

if (isset($_GET['delete'])) {
    unset($_SESSION['product_' . $_GET['delete']]);
    redirect("../public/checkout.php");
}

function cart()
{
    $total = 0;
    $tot_quantity = 0;
    //paypal
    $item_name = 1;
    $item_number = 1;
    $amount = 1;
    $quantity = 1;
    //paypal

    foreach ($_SESSION as $name => $value) {
        if ($value > 0) {

            if (substr($name, 0, 8) == "product_") {

                $length = strlen($name - 8);
                $id = substr($name, 8, $length);

                $query = query("select * from products where product_id = " . escape_string($id));
                confirm($query);
                while ($row = fetch_array($query)) {
                    $sub = $row['product_price'] * $value;

                    $product = <<<Delimeter
                <tr>
                    <td>{$row['product_title']}</td>
                    <td>&#36;{$row['product_price']}</td>
                    <td>{$row['product_quantity']}</td>
                    <td>{$value}</td>
                    <td>&#36;{$sub}</td>
                    <td><a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                        <a class="btn btn-success" href="../resources/cart.php?add={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a>
                        <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-trash"></span></a>  
                    </td>
                </tr>
                <input type="hidden" name="item_name_{$item_name}" value="{$row['product_title']}">
                <input type="hidden" name="item_number_{$item_number}" value="{$row['product_id']}">
                <input type="hidden" name="amount_{$amount}" value="{$row['product_price']}">
                <input type="hidden" name="quantity_{$quantity}" value="{$value}">
Delimeter;

                    echo $product;

                    $item_name++;
                    $item_number++;
                    $amount++;
                    $quantity++;

                    $total += $sub;
                    $tot_quantity += $value;
                }
            }
        }
    }

    $_SESSION['item_total'] = $total;
    $_SESSION['item_quantity'] = $tot_quantity;

}

function show_paypal_button()
{
    if (($_SESSION['item_quantity']) > 0) {
        $paypal_button = <<<delimeter

        <input type="image" name="upload"
       src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
       alt="PayPal - The safer, easier way to pay online">
delimeter;

        echo $paypal_button;
    }
}


function process_transaction()
{
    //tx = transaction id
    //amt = amount
    //cc = currency code
    //st = status

    if (isset($_GET['tx'])) {
        $amount = $_GET['amt'];
        $currency = $_GET['cc'];
        $transaction = $_GET['tx'];
        $status = $_GET['st'];


        $query = query("Insert into orders (order_amount , order_transaction, order_status, order_currency) values('{$amount}','{$transaction}','{$status}','{$currency}')");
        confirm($query);
        $query = query("SELECT order_id FROM orders WHERE order_transaction = '{$transaction}'");
        confirm($query);

        $order_id = fetch_array($query);

        foreach ($_SESSION as $name => $value) {
            if ($value > 0) {

                if (substr($name, 0, 8) == "product_") {

                    $length = strlen($name) - 8;
                    $id = substr($name, 8, $length);

                    $query = query("select * from products where product_id = " . escape_string($id));
                    confirm($query);
                    $row = fetch_array($query);
                    $sub = $row['product_price'] * $value;
                    $update1 = query("UPDATE `products` SET `product_quantity`=`product_quantity` - {$value} where `product_id`= {$id} ");
                    confirm($update1);


                    $insert_report = query("INSERT INTO reports(product_id , order_id, product_price, product_quantity) VALUES ({$id}, {$order_id['order_id']},{$sub},{$value})");

                    confirm($insert_report);

                }
            }
        }

    } else {
        redirect("index.php");
    }

}

?>