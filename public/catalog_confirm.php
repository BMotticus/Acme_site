<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Order Results</title>
<?php include("../includes/includeheader.html"); ?>

<div class="links">
    <?php display_links("",$_SESSION["status"]);?>  
</div>   
<div class="content1">
    <div class="contentTitle">
        <p>Order Confirmation</p><hr>
    </div>  
    <?php
    if($_SESSION['status'] == "in"){
        echo "<p>Order processed at " . date('l jS \of F Y h:i:s A') . "</p>";
        echo 'Thank you, <strong>' . $_SESSION['firstname'] . " " . $_SESSION['lastname'] . "</strong><br>";
        echo 'The following items will be shipped via ACME Rocket Ship Express in the next 30 seconds:<br>';
        echo '<ul>';
        foreach ($_SESSION['order_items'] as $key => $value) {
            $order = ($value > 1) ? 'orders' : 'order';
            echo '<li>' . $value . " " . $order . " of " . get_product_name($key) . " for $" . get_product_price($key) . ' each</li>';
        }
        echo '</ul>';
        echo 'Your total cost: $' . $_SESSION['cart_total'] . '<br>Will be billed to the following address:<br>';
        echo $_SESSION['address'] . ' ' . $_SESSION['city'] . ', ' . $_SESSION['state'] . " " .$_SESSION['zip'] . "<br>";
        if(isset($_SESSION['order_items'])){
        unset($_SESSION['order_items']);}
        if(isset($_SESSION['cart_total'])){
        unset($_SESSION['cart_total']);}
    } else {
        echo "Please Log in or fill out contact form to complete order";
        display_login_form();
        echo '<br><br><br><center>OR</center><br>';
        display_contact_form();
    }
    ?>
</div>     
<?php include("../includes/includedfooter.php"); ?>                                           

