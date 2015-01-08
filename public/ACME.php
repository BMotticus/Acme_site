<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>ACME Online</title>
<?php include("../includes/includeheader.html");?>

<div class="links">
    <?php display_links("Welcome",$_SESSION["status"]);?>  
</div>
        
        <div class="content1">
            <div class="contentTitle">
                <p>Catalog of Items</p><hr>
            </div>

            <div class="content2" >
                <table style="border-style: none;">
                    <tr>
                        <td><p>
                        We have been committed to distridution of such products and Anvils,  
                    exploding tennis balls, and flying bat suits since our founder Chuck
                    Jones established the company in the early part of the 1900. No 
                    matter where you are or what you need, we can fill the order. So 
                    remember as you look through the catalog, we will get what you
                    need and get it to you fast.</p>
                    
                    <p>Acme is a company established in 1920, we have whatever you
                    need for the moment. Our delivery is next to none. Our list of items
                    is extensive and if we do not have what you need, we can get a hold
                    of it. Acme means the prime, and our service is just that, the top, the
                    zenith, the Acme. We have a dedication to having what our
                    customers want and dilivering it within seconds of thier order.  
                        </p></td>
                        
                    </tr>
                </table>
            </div>
     </div>        
<?php include("../includes/includedfooter.php"); ?> 
