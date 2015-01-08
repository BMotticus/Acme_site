<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Login</title>
<?php include("../includes/includeheader.html"); ?>

<div class="links">
    <?php display_links("Login",$_SESSION["status"]);?>  
</div>

<div class="content1">
    <div class="contentTitle">
        <p>Login</p><hr>
    </div>  
    <?php display_login_form();?>
</div>      
<?php include("../includes/includedfooter.php"); ?>                                            

