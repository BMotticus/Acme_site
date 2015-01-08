<?php

function display_links($page, $status) {
    $page_links = array(
        "Login" => "login_main.php",
        "Catalog" => "catalog.php",
        "Contact Us" => "contact.php",
        "Welcome" => "ACME.php");
    if ($status == "in") {
        unset($page_links["Login"]);
        $page_links["Logout"] = "logout.php";
    }
    if ($status == "out") {
        unset($page_links["Logout"]);
        $page_links["Login"] = "login_main.php";
    }

    foreach ($page_links as $key => $value) {
        if ($key != $page) {
            echo "<a class='two' href='" . $value . "'>" . $key . "</a><br>";
        }
    }
}

function display_login_form() {
    $user = "";
    if (isset($_POST["username"])) {
        $user = val_input($_POST['username']);
    }
    ?>
<form id="loginForm" name="loginForm" method="post" action="login_confirm.php">
        <label for="username">Username:</label>
        <input id="username" type="text" name="username" 
               value="<?php echo htmlentities($user); ?>" size="35"><br>

        <label for="password">Password:</label>
        <input id="password" type="password" name="password" value="" size="35"><br>
        <div class="buttons">
            <input type="submit" id="login" class="loginButton" name="login" value="Login" >
        </div>
    </form>
    <?php
}

function display_contact_form() {
    $first_name = val_input($_POST["fname"]);
    $last_name = val_input($_POST["lname"]);
    $phone_number = val_input($_POST["phone"]);
    $address = val_input($_POST["address"]);
    $city = val_input($_POST["city"]);

    $zip = val_input($_POST["zip"]);
    $username = val_input($_POST["myusername"]);
    
    ?>

    <form id="theForm" name="theForm" method="post" action="results.php" >

        <label for="fname">First Name:</label>
        <input  id="fname" type="text" name="fname" 
                value="<?php if (isset($first_name)) {
        echo $first_name;
    } ?>" size="35"><br>

        <label for="lname">Last Name:</label>
        <input id="lname" type="text" name="lname" 
               value="<?php if (isset($last_name)) {
        echo $last_name;
    } ?>" size="35"><br>

        <label for="phone">Phone Number:</label>
        <input id="phone" type="text" name="phone" placeholder="###-###-####" 
               value="<?php if (isset($phone_number)) {
        echo $phone_number;
    } ?>" size="35"><br>

        <label for="address">Address:</label>
        <input id="address" type="text" name="address" 
               value="<?php if (isset($address)) {
        echo $address;
    } ?>" size="35"><br>

        <label for="city">City:</label>
        <input id="city" type="text" name="city" 
               value="<?php if (isset($city)) {
        echo $city;
    } ?>" size="35"><br>

        <label for="state">State:</label>                 
        <select id="state" name="state">
            <option value=""></option>
            <option value="AL">Alabama</option>
            <option value="AK">Alaska</option>
            <option value="AZ">Arizona</option>
            <option value="AR">Arkansas</option>
            <option value="CA">California</option>
            <option value="CO">Colorado</option>
            <option value="CT">Connecticut</option>
            <option value="DE">Delaware</option>
            <option value="DC">District Of Columbia</option>
            <option value="FL">Florida</option>
            <option value="GA">Georgia</option>
            <option value="HI">Hawaii</option>
            <option value="ID">Idaho</option>
            <option value="IL">Illinois</option>
            <option value="IN">Indiana</option>
            <option value="IA">Iowa</option>
            <option value="KS">Kansas</option>
            <option value="KY">Kentucky</option>
            <option value="LA">Louisiana</option>
            <option value="ME">Maine</option>
            <option value="MD">Maryland</option>
            <option value="MA">Massachusetts</option>
            <option value="MI">Michigan</option>
            <option value="MN">Minnesota</option>
            <option value="MS">Mississippi</option>
            <option value="MO">Missouri</option>
            <option value="MT">Montana</option>
            <option value="NE">Nebraska</option>
            <option value="NV">Nevada</option>
            <option value="NH">New Hampshire</option>
            <option value="NJ">New Jersey</option>
            <option value="NM">New Mexico</option>
            <option value="NY">New York</option>
            <option value="NC">North Carolina</option>
            <option value="ND">North Dakota</option>
            <option value="OH">Ohio</option>
            <option value="OK">Oklahoma</option>
            <option value="OR">Oregon</option>
            <option value="PA">Pennsylvania</option>
            <option value="RI">Rhode Island</option>
            <option value="SC">South Carolina</option>
            <option value="SD">South Dakota</option>
            <option value="TN">Tennessee</option>
            <option value="TX">Texas</option>
            <option value="UT">Utah</option>
            <option value="VT">Vermont</option>
            <option value="VA">Virginia</option>
            <option value="WA">Washington</option>
            <option value="WV">West Virginia</option>
            <option value="WI">Wisconsin</option>
            <option value="WY">Wyoming</option>
        </select><br>

        <label for="zip">Zip:</label>
        <input id="zip" type="text" name="zip" value="<?php if (isset($zip)) {
        echo $zip;
    } ?>" size="35"><br>

        <label for="myusername">Username:</label>
        <input id="myusername" type="text" name="myusername" 
               value="<?php if (isset($username)) {
        echo $username;
    } ?>" size="35"><br>

        <label for="mypassword">Password:</label>
        <input id="mypassword" type="password" name="mypassword" 
               value="" size="35"><br><br>
        <div class="buttons">
            <input class="create" id="create" type="submit" name="button" value="Create" >
            <input class="update" id="update" type="submit" name="button" value="Update" >
            <input class="search" id="search" type="submit" name="button" value="Search" >
        </div>
    </form>
    <?php
}

function show_results($first_name, $last_name) {
    global $link;

    $query = "select * from ACME.customers where firstname ='" . $first_name . "' AND lastname ='" . $last_name . "';";
    //, customers.lastname= '". $pa["lname"] ."'";
//                   select * from ACME.customers where firstname='brandon'
    // $search = "SELECT * FROM ACME.Car where Car.CarType = '" . $type."'";
    $result = mysqli_query($link, $query);

    //test for error
    confirm_query($result);
//    print_r($result);
    if (mysqli_num_rows($result) <= 0) {
        echo '<span class="resultErrors">Error: Could not locate account, please try again..</span><br>';
        display_contact_form();
    } else {
        echo "<p>Account created on " . date('l jS \of F Y h:i:s A') . "</p>";
        while ($customer = mysqli_fetch_array($result)) {

            $customer_info = "<ul><li>First Name : " . $customer['firstname'] . "</li>";
            $customer_info .= "<li>Last Name : " . $customer['lastname'] . "</li>";
            $customer_info .= "<li>Phone Number : " . $customer['phone'] . "</li>";
            $customer_info .= "<li>Address : " . $customer['address'] . "</li>";
            $customer_info .= "<li>City : " . $customer['city'] . "</li>";
            $customer_info .= "<li>State : " . $customer['state'] . "</li>";
            $customer_info .= "<li>zip : " . $customer['zip'] . "</li>";
            $customer_info .= "<li>Username : " . $customer['username'] . "</li>";
           
            echo $customer_info;
        }
    }
}

function get_product_options() {
    $link = db_connect();
    $query = "select * from ACME.products;";
    $result = mysqli_query($link, $query);
    //test for error
    confirm_query($result);
    while ($product = mysqli_fetch_array($result)) {
        $product_info = "<option id='" . $product['Price'] . "' value='" . $product['ProductID'] . "' title='" . $product['Description'] . "'>" . $product['Name'] . "</option>";
        echo $product_info;
    }
}

function get_cart_table() {
    global $item;
    global $amount;
    if (isset($_SESSION['orders'])) {
        $_SESSION['orders'] = $_SESSION['orders'] + 1;
    } else {
        $_SESSION['orders'] = 1;
    }
    if (!isset($_SESSION['order_items'])) {
        $_SESSION['order_items'] = array();
    }
    if (array_key_exists($item, $_SESSION['order_items'])) {

        $old = $_SESSION['order_items'][$item];
        $_SESSION['order_items'][$item] = $old + $amount;
    } else {
        $_SESSION['order_items'][$item] = $amount;
    }

    if (isset($_SESSION['cart_total'])) {
        unset($_SESSION['cart_total']);
    }
    get_cart_rows();
}

function get_cart_rows(){
    $cart = '';
    foreach ($_SESSION['order_items'] as $key => $value) {
        $price = get_product_price($key);
        $subtotal = $price * $value;
        if (isset($_SESSION['cart_total'])) {
            $oldtotal = $_SESSION['cart_total'];
            $_SESSION['cart_total'] = $oldtotal + $subtotal;
        } else {
            $_SESSION['cart_total'] = $subtotal;
        }
        $cart .= '<tr>';
        $cart .= '<td><b>Item:</b>' . get_product_name($key) . '</td><td><b>Qty:</b>' . $value . '</td><td><b>Price:$</b><span id="sub">' . $subtotal . '</span></td>';
        $cart .= '</tr>';
    }
    ?>
    <div id="cart">
        <form id="cartForm" name="cartForm" method="post" action="#"> 
            <table class="cartItems">
                <thead>
                    <tr>
                        <th>Cart Items:</th>
                        <th></th>
                        <th id="thremove">
                            <input type='submit' class='remove' id='remove' name='remove' value='Remove Last Item'>
                        </th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th width="450px"></th>
                        <th class="footTotal" align="right">Total:$</th>
                        <th class="footTotal" id="footTotal" align="left"><?php
    if (isset($_SESSION['cart_total'])) {
        echo $_SESSION['cart_total'];
    }
    ?></th>
                    </tr>
                </tfoot>
                <tbody>
    <?php echo $cart; //displaying cart info   ?>
                </tbody>
            </table><!--  -->
            <input type="submit" class="reset" id="reset" name="reset" value="Reset Form">   
            <input type="submit" class="purchase" id="purchase" name="purchase" value="Submit Order">
        </form></div><?php
}

function get_product_name($id) {
    $name = '';
    switch ($id) {
        case 1:
            $name = "Anvil";
            break;
        case 2:
            $name = "Axle Grease";
            break;
        case 3:
            $name = "Atom Re-Arranger";
            break;
        case 4:
            $name = "Bed Springs";
            break;
        case 5:
            $name = "Bird Seed";
            break;
        case 6:
            $name = "Blasting Powder";
            break;
        case 7:
            $name = "Cork";
            break;
        case 8:
            $name = "Disintigration Pistol";
            break;
        case 9:
            $name = "Earthquake Pills";
            break;
        case 10:
            $name = "Female Roadrunner Costume";
            break;
        case 11:
            $name = "Gaint Rubber Band";
            break;
        case 12:
            $name = "Instant Girl";
            break;
        case 13:
            $name = "Iron Carrot";
            break;
        case 14:
            $name = "Jet Propelled Unicycle";
            break;
        case 15:
            $name = "Out-Board Moto";
            break;
        case 16:
            $name = "Railroad Track";
            break;
        case 17:
            $name = "Rocket Sled";
            break;
        case 18:
            $name = "Super Outfit";
            break;
        case 19:
            $name = "Time Space Gun";
            break;
        case 20:
            $name = "X-Ray";
            break;
        default:
            $name = "You have not made a choice.";
            break;
    }
    return $name;
}

function get_product_price($id) {
    $price = '';
    switch ($id) {
        case 1:
            $price = 99.99;
            break;
        case 2:
            $price = 4.99;
            break;
        case 3:
            $price = 9999.99;
            break;
        case 4:
            $price = 1.99;
            break;
        case 5:
            $price = 5.99;
            break;
        case 6:
            $price = 10.99;
            break;
        case 7:
            $price = 0.99;
            break;
        case 8:
            $price = 158.39;
            break;
        case 9:
            $price = 19.99;
            break;
        case 10:
            $price = 39.99;
            break;
        case 11:
            $price = 2.59;
            break;
        case 12:
            $price = 1.00;
            break;
        case 13:
            $price = 6.75;
            break;
        case 14:
            $price = 999.99;
            break;
        case 15:
            $price = 129.99;
            break;
        case 16:
            $price = 75.25;
            break;
        case 17:
            $price = 502.19;
            break;
        case 18:
            $price = 196.99;
            break;
        case 19:
            $price = 2599.99;
            break;
        case 20:
            $price = 1199.99;
            break;
        default:
            $price = "You have not made a choice.";
            break;
    }
    return $price;
}

function show_catalog_form() {
    ?>
    <div class="catalog">
        <form id="catalogue" name="catalogue" method="post" action="#">
            <label for="products">Please select one of our items:</label><br>
            <select id="products" name="products">
                <option value=""></option>
        <?php
        get_product_options();
        ?>
            </select><span class="catalogErrors">*</span>
            <label for="quantity">Quantity:</label>
            <input type="text"  id="quantity" name="quantity" value="" size="3">
            <span class="catalogErrors">*</span>&nbsp;&nbsp;&nbsp;
            <input type="submit" id="addToCart" class="addToCart" name="addToCart" value="Add To Cart">
        </form><br>

        <div id="discritpion">

        </div>
        <?php
        $b = FALSE;
        if (isset($_POST['products']) && isset($_POST['quantity'])) {//checking for submission
            $b = is_numeric($_POST['quantity']);
            if (empty($_POST['products']) || empty($_POST['quantity']) || !$b) {
                echo '<span class="catalogErrors">Please select an item and enter a numeric quantity to continue...<span><br>';
            } else {
                get_cart_table();
            }
        } else {
            if (isset($_POST['purchase'])) {
                redirect_to('catalog_confirm.php');
            }
            if (($_SESSION['status'] != "in") || (isset($_POST['reset']))) {
                
                unset($_SESSION['order_items']);
                unset($_SESSION['orders']);
            }
            if (isset($_POST['remove'])) {
            
                echo 'Item Removed';
                
                    array_pop($_SESSION['order_items']);
                    unset($_SESSION['cart_total']);
 
                get_cart_rows();
        }
        }//end of checking submit


        ?>
    </div>    
    <?php
}

