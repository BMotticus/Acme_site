<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Contact Us</title>
<?php include("../includes/includeheader.html"); ?>
<?php echo $defmess;?>
<div class="links">
    <?php display_links("Contact Us",$_SESSION["status"]);?>  
</div>  
<div class="content1">
    <div class="contentTitle">
        <p>Contact Us</p><hr>
    </div>          
    <div class="errorMessage"></div>
   <?php display_contact_form();?>
</div>

<?php include("../includes/includedfooter.php"); ?> 





