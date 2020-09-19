<?php
 session_start();
// connect to the db
$sjUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sjUsers);


    header('Content-Type: application/json');
    echo json_encode($ajUsers);
  