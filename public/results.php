<?php session_start(); ?><?php
include("../includes/includeCSS.html");
require_once ("../includes/includefunctions.php");
require_once ("../includes/outputfunctions.php");
?><title>Results</title>
<?php include("../includes/includeheader.html"); ?>

<div class="links">
    <?php display_links("",$_SESSION["status"]);?>  
</div>   
<div class="content1">
    <div class="contentTitle">
        <h2>Results</h2><hr>
    </div>          
    <div class="results">

    <?php
    $re_names = "/^[a-zA-Z ]+$/";
    $re_phone = "/^(?:\\([0-9]{3}\\)||[0-9]{3})(|-)[0-9]{3}(|-)[0-9]{4}$/";
    $re_address = "/^(?:[a-zA-Z\\. ]{1,15}|[0-9 ]{1,15}){3,10}$/";
    $re_zip = "/^[0-9]{5}([\-]?[0-9]{4})?$/";
    $re_user = "/^.{5,}$/";

    $first_name = $last_name = $phone_number = $address = $city = $state = $zip = $username = $password = "";
    if ($_POST && isset($_POST["fname"], $_POST["lname"])) {

        $first_name = val_input($_POST["fname"]);
        $last_name = val_input($_POST["lname"]);
        $phone_number = val_input($_POST["phone"]);
        $address = val_input($_POST["address"]);
        $city = val_input($_POST["city"]);
        $state = val_input($_POST["state"]);
        $zip = val_input($_POST["zip"]);
        $username = val_input($_POST["myusername"]);
        $password = $_POST["mypassword"];
    }
    $errors = false;
    $assoc = array("fname" => $first_name, "lname" => $last_name);
    $choice = $_POST['button'];
    

    switch ($choice) {    //need more validation check presence
        case "Create":
            //validate presence create information
            if (!filled_out($_POST)) {
                alert_errors("Please complete form before creating user");
                break;
            }
            $errors .= val_info($re_names, $first_name);
            $errors .= val_info($re_names, $last_name);
            $errors .= val_info($re_phone, $phone_number);
            $errors .= val_info($re_address, $address);
            $errors .= val_info($re_names, $city);
            $errors .= val_info($re_zip, $zip);
            $errors .= val_info($re_user, $username);
            $errors .= val_info($re_user, $password);
            if ($errors != "") {
                $message = "Please fix before creating user: " . $errors;
                alert_errors($message);
                break;
            }
            echo "<h4>USER CREATED:</h4>";
            $hash_pass = password_encrypt($password);

            //database query
            $link = db_connect();
            
            $query = "insert into ACME.customers (firstname, lastname, phone, address, city, state, zip, username, password) values ("
                    . "'{$first_name}', '{$last_name}', '{$phone_number}', '{$address}', '{$city}', '{$state}', '{$zip}', '{$username}', '{$hash_pass}')";
            $result = mysqli_query($link, $query);
            //test for error
            confirm_query($result); 
            show_results($first_name, $last_name);
            mysqli_free_result($result);
            break;
        case "Update":
            //validate presence create information
            if (!filled_out($_POST)) {
                alert_errors("Please complete form before updating user");
                break;
            }
            $errors .= val_info($re_names, $first_name);
            $errors .= val_info($re_names, $last_name);
            $errors .= val_info($re_phone, $phone_number);
            $errors .= val_info($re_address, $address);
            $errors .= val_info($re_names, $city);
            $errors .= val_info($re_zip, $zip);
            $errors .= val_info($re_user, $username);
            $errors .= val_info($re_user, $password);
            if ($errors != "") {
                $message = "Please fix before updating user: " . $errors;
                alert_errors($message);
                break;
            }


            echo "<h4>USER UPDATED:</h4>";
            $hash_pass = password_encrypt($password);
            //database query
            $link = db_connect();
            $query = "UPDATE ACME.customers SET firstname='" . $first_name . "',lastname='" . $last_name . "',phone='" . $phone_number . "',address='" . $address . "',";
            $query .="city='" . $city . "',state='" . $state . "',zip='" . $zip . "',username='" . $username . "',password='" . $hash_pass . "' WHERE firstname ='" . $first_name . "' AND lastname ='" . $last_name . "';";
            $result = mysqli_query($link, $query);

            confirm_query($result);
            show_results($first_name, $last_name);
            mysqli_free_result($result);
            break;
        case "Search":
            //validate presence search information
            if (!filled_out($assoc)) {
                alert_errors("Please enter first and last name of user");
                break;
            }
            $errors .= val_info($re_names, $first_name);
            $errors .= val_info($re_names, $last_name);
            if ($errors != "") {
                $message = "Please fix before searching user: " . $errors;
                alert_errors($message);
                break;
            }

            echo "<h4>SEARCH RESULTS:</h4>";

            $link = db_connect();
            show_results($first_name, $last_name);
            break;
    }
    ?>



</div>
</div>
<?php include("../includes/includedfooter.php"); ?>  
