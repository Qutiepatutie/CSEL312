<?php
    session_start();
    //connecting to Database

    $host = "localhost";
    $user = "root";
    $password = "";
    $database_name = "storefront";

    $mysqli = mysqli_connect($host, $user, $password, $database_name);

    $categories_table = "CREATE TABLE IF NOT EXISTS store_categories (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                cat_title VARCHAR (50) UNIQUE,
                cat_desc TEXT
                );";
    
    mysqli_query($mysqli, $categories_table);

    $items_table = "CREATE TABLE IF NOT EXISTS store_items (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                cat_id INT NOT NULL,
                item_title VARCHAR (75),
                item_price FLOAT (8,2),
                item_desc TEXT,
                item_image VARCHAR (50)
                );";

    mysqli_query($mysqli, $items_table);

    $items_size_table = "CREATE TABLE IF NOT EXISTS store_item_size (
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    item_id INT NOT NULL,
                    item_size VARCHAR (25)
                    );";

    mysqli_query($mysqli, $items_size_table);

    $items_color_table = "CREATE TABLE IF NOT EXISTS store_item_color (
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    item_id INT NOT NULL,
                    item_color VARCHAR (25)
                    );";

    mysqli_query($mysqli, $items_color_table);

    $shoppertrack_table = "CREATE TABLE IF NOT EXISTS store_shoppertrack (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                session_id VARCHAR (32),
                sel_item_id INT,
                sel_item_qty SMALLINT,
                sel_item_size VARCHAR(25),
                sel_item_color VARCHAR(25),
                date_added DATETIME
                );";

    mysqli_query($mysqli, $shoppertrack_table);

    $orders_table = "CREATE TABLE IF NOT EXISTS store_orders (
                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                order_date DATETIME,
                order_name VARCHAR (100),
                order_address VARCHAR (255),
                order_city VARCHAR (50),
                order_state CHAR(2),
                order_zip VARCHAR(10),
                order_tel VARCHAR(25),
                order_email VARCHAR(100),
                item_total FLOAT(6,2),
                shipping_total FLOAT(6,2),
                authorization VARCHAR (50),
                status ENUM('processed', 'pending')
                );";

    mysqli_query($mysqli, $orders_table);

    $orders_items_table = "CREATE TABLE IF NOT EXISTS store_orders_items (
                    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                    order_id INT,
                    sel_item_id INT,
                    sel_item_qty SMALLINT,
                    sel_item_size VARCHAR(25),
                    sel_item_color VARCHAR(25),
                    sel_item_price FLOAT(6,2)
                    );";

    mysqli_query($mysqli, $orders_items_table);

    $display_block = "<h1>My Categories</h1>
    <p>Select a category to see its items</p>";

    $get_category_sql = "SELECT * FROM store_categories ORDER BY cat_title";

    $get_category_result = mysqli_query($mysqli,$get_category_sql) or die(mysqli_error($mysqli));

    if (mysqli_num_rows($get_category_result) < 1) {
        $display_block = "<p><em>Sorry, no categories to browse.</em></p>";
    } else 
    {
        while ($cats = mysqli_fetch_array($get_category_result)) {
            $category_id = $cats['id'];
            $category_title = strtoupper(stripslashes($cats['cat_title']));
            $category_description = stripslashes($cats['cat_desc']);    
            
            $display_block .= "<p><strong><a href=\"".$_SERVER['PHP_SELF']."?category_id=".$category_id."\">".$category_title."</a></strong><br/>".$category_description."</p>";  
        
            if (isset($_GET['category_id']) && ($_GET['category_id'] == $category_id)) {
                //create safe value for use
                $safe_category_id = mysqli_real_escape_string($mysqli,$_GET['category_id']);   
                //get items
                $get_items_sql = "SELECT id, item_title, item_price FROM store_items 
                                  WHERE id = '".$safe_category_id."' ORDER BY item_title";
                
                $get_items_result = mysqli_query($mysqli, $get_items_sql) 
                                 or die(mysqli_error($mysqli)); 

                if (mysqli_num_rows($get_items_result) < 1) {
                    $display_block .= "<p><em>Sorry, no items in this category.</em></p>";
                } else {
                    $display_block .= "<ul>";
                    while ($items = mysqli_fetch_array($get_items_result)) {
                        $item_id = $items['id'];
                        $item_title = stripslashes($items['item_title']);
                        $item_price = $items['item_price']; 
                        
                        $display_block .= "<li><a href=\"displayStore.php?item_id=".$item_id."\">".$item_title."</a>(\$".$item_price.")</li>";
                    }
                    $display_block .= "</ul>";
                }
                //free results
                mysqli_free_result($get_items_result);
            }
        }
    }
    //free results
    mysqli_free_result($get_category_result);
    //close connection to MySQL
    mysqli_close($mysqli);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo $display_block; ?>
</body>
</html>