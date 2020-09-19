<?php 
    session_start();
    $_SESSION['email'] = $_POST['email']; 
    $_SESSION['password'] = $_POST['password']; 
    $sUsers = file_get_contents('users.txt');
    $jUsers = json_decode($sUsers, true);
    $password = $_POST['password'];
    
    for($i = 0; $i < count($jUsers); $i++) {
        if( $_POST['email'] == $jUsers[$i]['userEmail'] && $hashedPassword = password_verify( $password, $jUsers[$i]['userPassword'])  ){
            $_SESSION['id'] = ($jUsers[$i]['userId']);
            $_SESSION['name'] = $jUsers[$i]['userName'];
            header('Location: index.php');
            exit();
        } else {
            ?>

            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title></title>
            </head>
            <body>
                <H1> INVALID EMAIL/PASSWORD</H1>
            </body>
            </html>
           <?php    
        }
    }
    
    ?>
