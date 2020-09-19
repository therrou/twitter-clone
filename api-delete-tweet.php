<?php
 session_start();
 try{ 
 if ( ! isset($_POST['tweetId']) ) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing id"}';
    exit();
    }

if (strlen($_POST['tweetId']) != 13) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"id is not valid"}';
    exit();
}

$sUsers = file_get_contents('users.txt');
$ajUsers = json_decode($sUsers, true);

for ($i = 0; $i < sizeof($ajUsers); $i++) { 
    for ($j=0; $j < sizeof($ajUsers[$i]['Tweets']) ; $j++) {
        if( $ajUsers[$i]['Tweets'][$j]['TweetId'] == $_POST['tweetId'] && $_SESSION['id'] == $ajUsers[$i]['userId'] && $_SESSION['email'] == $ajUsers[$i]['userEmail'] ){
           Array_splice($ajUsers[$i]['Tweets'], $j, 1);
           header('Content-Type: application/json');
           echo '{"id": "' . $_POST['tweetId'] . '", "message" :"tweet has been deleted"}';
           $sUsers = json_encode($ajUsers, true);
           file_put_contents('users.txt', $sUsers);
           exit();
        } else{
            echo 'wrong id';
            exit();
        }
    }
}
 }
 catch(Exception $ex){
     echo '{"message":"error' .__LINE__.' "}';
 }
//$_SESSION['id'] == $ajUsers[$i]['userId'] && 

// && $_SESSION['id'] == $ajUsers[$i]['userId'] && $_SESSION['email'] == $ajUsers[$i]['userEmail']
// && $_SESSION['id'] == $ajUsers[$i]['userId'] && $_SESSION['email'] == $ajUsers[$i]['userEmail'] 