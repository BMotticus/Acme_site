<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>ACME Catalog</title>
<?php include("../includes/includeheader.html"); ?>

<div class="links">
    <?php display_links("Catalog",$_SESSION["status"]);?>  
</div>  
<div class="content1">
    <div class="contentTitle">
        <p>Catalogue</p><hr>
    </div>  
    <?php 
    if ($_SESSION['status'] == "in"){
        echo 'Welcome back ' . $_SESSION['firstname'] . ', you are now logged in.<br>';
    }
    $item = isset($_POST['products']) ? $_POST['products'] : "";
    $amount = isset($_POST['quantity']) ? $_POST['quantity'] : "";
    show_catalog_form(); ?>
</div>
<br><br>
<?php mysqli_free_result($result); ?>       
<?php include("../includes/includedfooter.php"); ?>        
