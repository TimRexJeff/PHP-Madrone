<?php
    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../config/Database.php';
    include_once '../../models/User.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();

    //Instantiate user object
    $user = new User($db);

    // Get ID
    $user->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Get user
    $user->read_single();

    // Create array
    $user_arr = array(
        'id' => $user->id,
        'email' => $user->email,
        'display_name' => $user->display_name,
        'company_name' => $user->company_name
    );

    // Make JSON
    print_r(json_encode($user_arr));