<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Confirmation</title>
<?php include("../includes/includeheader.html"); ?>



<div class="content1">
    <div class="contentTitle">
        <p>Confirmation</p><hr>
    </div>
    <?php
    $username = $password = $error = "";
    $regex_users = "/^.{5,}$/";
    if ($_POST && isset($_POST["username"], $_POST["password"])) {
        $username = val_input($_POST['username']);
        $password = $_POST['password'];
    }
    $error .= val_info($regex_users, $username);
    $error .= val_info($regex_users, $password);
    if ($error != "") {
        ?><div class="links">
        <?php display_links("",$_SESSION["status"]);?> 
        </div><?php
    echo '<div class="resultErrors">You have entered invalid information, please try again.</div>';
    display_login_form();
   
    
} else {
    $link = db_connect();
    $found = attempt_login($username, $password);
    if (!$found) {
            ?><div class="links">
            <?php display_links("",$_SESSION["status"]); ?>  
            </div>
            <form action="contact.php">
                <center><label>Create new account click here</label>
                    <input type="submit" id="createNew" name="createNew" value="New Account"></form><br>
                    OR</center><br>
                <?php
                display_login_form();
            } else {//if validation/login was successful
                redirect_to("catalog.php");
            }
        }//closing of ELSE validation doesn't fail
        ?>
</div>  

<?php mysqli_free_result($result); ?>       
<?php include("../includes/includedfooter.php"); ?>                                          

