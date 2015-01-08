<?php

date_default_timezone_set('MST7MDT');

function db_connect() {
    define("DB_SERVER", "localhost");
    define("DB_USER", "root");
    define("DB_PASS", "PASSWORD");
    define("DB_NAME", "ACME");

    $link = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if (mysqli_connect_errno()) {
        die("Database connection failed: " .
                mysqli_connect_error() .
                " (" . mysqli_connect_errno() . ")"
        );
    }
    return $link;
}

function val_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function redirect_to($newLocation) {
    header("Location: " . $newLocation);
    exit;
}

function filled_out($form_vars) {
    // test that each variable has a value
    foreach ($form_vars as $key => $value) {
        if (!isset($key) || ($value == '')) {

            return false;
        }
    }
    return true;
}

function confirm_query($result_set){
    if (!$result_set) {
        die("Database query failed");
    }
}

function val_info($re, $str) {
    $var1 = "";
    if (preg_match($re, $str)) {
        //valid entry
        //do nothing
    } else {
        //invalid entry
        $var1 = " <strong>" . $str . "</strong> is invalid";
    }
    return $var1;
}

function alert_errors($message) {
    echo '<div class="errorMessage">' . $message . '</div>';
    display_contact_form();
}

function attempt_login($u, $p) {
    global $link;
    $existing_password = "";
    //find user
    $query = "SELECT * FROM ACME.customers WHERE username='" . $u . "' LIMIT 1";
    //check password
    $result = mysqli_query($link, $query);
    confirm_query($result);
    if (mysqli_num_rows($result) <= 0) {
        echo '<span class="resultErrors">Username/password was incorrect or account does not exist:</span><br>';
        return false;
    } else {
        
        while ($customer = mysqli_fetch_array($result)) {
            $_SESSION["firstname"] = $customer['firstname'];
            $_SESSION["lastname"] = $customer['lastname'];
            $_SESSION["phone"] = $customer['phone'];
            $_SESSION["address"] = $customer['address'];
            $_SESSION["city"] = $customer['city'];
            $_SESSION["state"] = $customer['state'];
            $_SESSION["zip"] = $customer['zip'];
            $_SESSION["username"] = $customer['username'];
            $existing_password = $customer['password'];
            $_SESSION["account"] = $customer['id'];
        }
        if(check_password($p, $existing_password)){
        $_SESSION["status"] = "in";
        return true;
        } else {
            echo '<span class="resultErrors">Username/password was incorrect or account does not exist:</span><br>';
            
            return false;
        }
    }
    //return $result;
}

function password_encrypt($pass){
          $hash_format = "$2y$10$";   
	  $salt_length = 22; 					
	  $salt = generate_salt($salt_length);
	  $format_and_salt = $hash_format . $salt;
	  $hash = crypt($pass, $format_and_salt);
		return $hash;
}

function generate_salt($length){
    $unique_random_string = md5(uniqid(mt_rand(), true));
	  $base64_string = base64_encode($unique_random_string);
	  $modified_base64_string = str_replace('+', '.', $base64_string);
	  $salt = substr($modified_base64_string, 0, $length);
	  
		return $salt;
}

function check_password($pass, $exist){
    $hash = crypt($pass, $exist);
    
    if($hash === $exist){
        return true;
    }else{
        return false;
    }
}

function localize_us_number($phone) {
    $numbers_only = preg_replace("/[^\d]/", "", $phone);
    return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
}

$phone_number = preg_replace("/[^0-9]/", "", $phone_number);
?>
   