<?php
    session_start();
    $hostname ="localhost";
    $username = "root";
    $password = "";
    $database = "fooddeliver_database";

    mysqli_report(MYSQLI_REPORT_STRICT|MYSQLI_REPORT_ERROR); //This is needed to use oop on user data

   $db = new mysqli($hostname,$username,$password,$database);
    if($db->connect_error) echo "Unable to connect to database";
    // else echo "connection seccessful";

    //CREATE USER TABLE IN DATABASE
    $create_user_table = $db->query("CREATE TABLE IF NOT EXISTS users (
        user_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50)  NOT NULL, 
        firstname VARCHAR(50)  NOT NULL, 
        lastname VARCHAR(50)  NOT NULL, 
        email VARCHAR(100)  NOT NULL, 
        phone VARCHAR(20)  NOT NULL, 
        gender VARCHAR(10)  NOT NULL,
        dob DATE NOT NULL, 
        password VARCHAR(50)  NOT NULL, 
        healthchallenges VARCHAR(50) NOT NULL, 
        specific_challenge VARCHAR(50), 
        address VARCHAR(200)  NOT NULL, 
        status TINYINT(5) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

    //CREATE MENU TABLE IN DATABASE
    $create_menu_table = $db->query("CREATE TABLE IF NOT EXISTS menus (
        menu_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        dish_category VARCHAR(50)  NOT NULL, 
        dish_title VARCHAR(50)  NOT NULL, 
        dish_portion VARCHAR(50)  NOT NULL, 
        dish_price DECIMAL(8,2)  NOT NULL, 
        dish_time VARCHAR(10)  NOT NULL,
        dish_desc VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");




    //CREATE POPULAR TABLE IN DATABASE
    $create_popular_table = $db->query("CREATE TABLE IF NOT EXISTS populars (
        popular_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        dish_category VARCHAR(50)  NOT NULL, 
        dish_title VARCHAR(50)  NOT NULL, 
        dish_portion VARCHAR(50)  NOT NULL, 
        dish_price DECIMAL(8,2)  NOT NULL, 
        dish_time VARCHAR(10)  NOT NULL,
        dish_desc VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");


    //  CREATE ORDER TABLE IN DATABASE

     $create_order_table = $db->query("CREATE TABLE IF NOT EXISTS orders (
        order_id INT(255)UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(20) NOT NULL,
        total_amount DECIMAL(10, 2) NOT NULL,
        username VARCHAR(255) NOT NULL,
        firstname VARCHAR(255) NOT NULL,
        lastname VARCHAR(255)NOT NULL,
        phone VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        healthchallenges TEXT,
        address TEXT,
        is_confirmed INT DEFAULT 0,
        order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

    
    //CREATE ORDER-ITEM TABLE IN DATABASE
    $create_order_item_table = $db->query("CREATE TABLE IF NOT EXISTS order_item (
        order_item_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT, 
        order_id INT(255)NOT NULL, 
        dish_id VARCHAR(50)  NOT NULL, 
        dish_title VARCHAR(50)  NOT NULL, 
        dish_category VARCHAR(50)  NOT NULL, 
        dish_portion VARCHAR(50)  NOT NULL, 
        price DECIMAL(8,2)  NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

        //CREATE CATEGORY TABLE IN DATABASE
    $create_category_table = $db->query("CREATE TABLE IF NOT EXISTS categorys (
        category_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        category_title VARCHAR(50)  NOT NULL, 
        category_desc VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

 
    //CREATE SALAD TABLE IN DATABASE
    $create_salad_table = $db->query("CREATE TABLE IF NOT EXISTS salads (
        salad_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        salad_category VARCHAR(50)  NOT NULL, 
        salad_title VARCHAR(50)  NOT NULL, 
        salad_portion VARCHAR(50)  NOT NULL, 
        salad_price DECIMAL(8,2)  NOT NULL, 
        salad_time VARCHAR(10)  NOT NULL,
        salad_desc VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");

     //CREATE NONDAIRY TABLE IN DATABASE
     $create_nondairy_table = $db->query("CREATE TABLE IF NOT EXISTS nondairys (
        nondairy_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
        image VARCHAR(50)  NOT NULL, 
        nondairy_category VARCHAR(50)  NOT NULL, 
        nondairy_title VARCHAR(50)  NOT NULL, 
        nondairy_portion VARCHAR(50)  NOT NULL, 
        nondairy_price DECIMAL(8,2)  NOT NULL, 
        nondairy_time VARCHAR(10)  NOT NULL,
        nondairy_desc VARCHAR(255) NOT NULL, 
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    ) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");


   //CREATE GLUTEN TABLE IN DATABASE
   $create_gluten_table = $db->query("CREATE TABLE IF NOT EXISTS glutens (
    gluten_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(50)  NOT NULL, 
    gluten_category VARCHAR(50)  NOT NULL, 
    gluten_title VARCHAR(50)  NOT NULL, 
    gluten_portion VARCHAR(50)  NOT NULL, 
    gluten_price DECIMAL(8,2)  NOT NULL, 
    gluten_time VARCHAR(10)  NOT NULL,
    gluten_desc VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");


$create_vegan_table = $db->query("CREATE TABLE IF NOT EXISTS vegans (
    vegan_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(50)  NOT NULL, 
    vegan_category VARCHAR(50)  NOT NULL, 
    vegan_title VARCHAR(50)  NOT NULL, 
    vegan_portion VARCHAR(50)  NOT NULL, 
    vegan_price DECIMAL(8,2)  NOT NULL, 
    vegan_time VARCHAR(10)  NOT NULL,
    vegan_desc VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");



$create_sugardessert_table = $db->query("CREATE TABLE IF NOT EXISTS sugardesserts (
    sugardessert_id INT(255)UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(50)  NOT NULL, 
    sugardessert_category VARCHAR(50)  NOT NULL, 
    sugardessert_title VARCHAR(50)  NOT NULL, 
    sugardessert_portion VARCHAR(50)  NOT NULL, 
    sugardessert_price DECIMAL(8,2)  NOT NULL, 
    sugardessert_time VARCHAR(10)  NOT NULL,
    sugardessert_desc VARCHAR(255) NOT NULL, 
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci, ENGINE=InnoDB");





?>