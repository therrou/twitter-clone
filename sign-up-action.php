<?php 

session_start();

// VALIDATIONS //
        if( ! $_POST) { header('Location: sign-up.php'); }

        if( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL)  ) {
                echo 'Please enter a valid email';
                exit();
        };
        if( strlen($_POST['name' ]) <=2   ) {
            echo 'Name is too short';
            exit();
        };

        if( strlen($_POST['password' ]) <=2   ) {
            echo 'Your password is too short';
            exit();
        };

        if( strlen($_POST['password' ]) > 60   ) {
            echo 'Your password is too long';
            exit();
        };
        // OPEN DB AND LOOP THROUGH THE USERS
        $sUsers = file_get_contents('users.txt');
        $jUsers = json_decode($sUsers, true);

        for( $i = 0; $i < count($jUsers); $i++){
            if( $_POST['email'] == $jUsers[$i]['userEmail'] ){
                echo 'email already in use';
                exit();
            }
        }

        $userId = uniqid();
        $_SESSION['email'] = $_POST['email']; 
        $_SESSION['name'] = $_POST['name']; 
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['id'] = $userId;

        $password = $_POST['password'];
        $hashPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create a new JSON User for each new user
        $jUser->userId = $userId;
        $jUser->userEmail = $_POST['email']; 
        $jUser->userName = $_POST['name']; 
        $jUser->userPassword = $hashPassword;
        $jUser->Tweets = new stdClass;

        array_push($jUsers, $jUser);

        $sUsers = json_encode($jUsers, true, JSON_PRETTY_PRINT);
        file_put_contents('users.txt', $sUsers);
        header('Location: index.php');
        exit();
