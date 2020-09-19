<?php
 session_start();
 if (!isset($_POST['tweetId'])) {
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

 if (!isset($_POST['updatedTweet'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing message"}';
    exit();
    }
  
 if (strlen($_POST['updatedTweet']) <= 1) {
 http_response_code(400);
 header('Content-Type: application/json');
 echo '{"error":"tweet must be at least 2 characters"}';
 exit();
 }
 if (strlen($_POST['updatedTweet']) > 140) {
 http_response_code(400);
 header('Content-Type: application/json');
 echo '{"error":"tweet cannot be longer than 140 characters"}';
 exit();
 }
 
 // CONNECTION WITH THE DATABASE
 $sUsers = file_get_contents('users.txt');
 $ajUsers = json_decode($sUsers, true);
 for ($i = 0; $i < sizeof($ajUsers); $i++) {
    for ($j=0; $j < sizeof($ajUsers[$i]['Tweets']) ; $j++) {
        if( $ajUsers[$i]['userId']== $_SESSION['id']) {
            $ajUsers[$i]['Tweets'][$j]['tweetMessage'] = $_POST['updatedTweet'];
            header('Content-Type: application/json');
            echo '{"message":"tweet has been updated"}';
            $sUsers = json_encode($ajUsers);
            file_put_contents('users.txt', $sUsers);
            exit();
        }else{
            echo 'Id not valid';
            exit();
        }
    }
}
header('Content-Type: application/json');
http_response_code(400);
echo '{"message" :"tweet not found"}';


// && $_SESSION['id'] = $ajUsers[$i]['userId'])


//   foreach($ajUsers as $ajUser){
//      foreach($ajUser['Tweets'] as $sTweets){
//          if($sTweets['TweetId'] ==  $_POST['tweetId']){
//               echo $sTweets['tweetMessage'];
//              $sTweets['tweetMessage'] = $_POST['updatedTweet'];
//             echo $sTweets['tweetMessage'];
//             header('Content-Type: application/json');
//             echo '{"message":"tweet has been updated"}';
//             $sUsers = json_encode($sTweets['tweetMessage']);
//             file_put_contents('users.txt', $sUsers);
//              exit();
//          }
//      }
//  }