<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Logout</title>
<?php include("../includes/includeheader.html"); ?>

<div class="links">
    <?php 
    unset($_SESSION["status"]);
    display_links("",$_SESSION["status"]);
    session_destroy();
    ?>  
</div>   
<div class="content1">
    
    <div class="contentTitle">
        <p>You are logged out</p>
    </div>  
    
    <!--Add content here-->
</div>  
 
<?php include("../includes/includedfooter.php"); ?>  