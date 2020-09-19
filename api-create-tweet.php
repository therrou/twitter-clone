<?php
  session_start();
  
try{
  $sTweetId = uniqid();
  if( ! isset($_POST['tweetContent']) ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"missing content"}';
    exit();
  }
  if( strlen($_POST['tweetContent']) < 2 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"content must be at least 2 characters"}';
    exit();
  }
  if( strlen($_POST['tweetContent']) > 100 ){
    http_response_code(400);
    header('Content-Type: application/json');
    echo '{"error":"content cannot be longer than 100 characters"}';
    exit();
  }
  // Create a new JSON Object for each Tweet
  $jTweet               = new stdClass(); 
  $jTweet->TweetId      = $sTweetId;
  $jTweet->userEmail    = $_SESSION['email'];
  $jTweet->tweetMessage = $_POST['tweetContent'];
  $jTweet->tweetDate    = date('d-m-Y-H-i');
 
  $sUsers = file_get_contents('users.txt');
  $ajUsers = json_decode($sUsers, true);

// Loop through the Users to match user through his ID and save it.
  for( $i = 0; $i < count($ajUsers); $i++){
    if( $_SESSION['email'] == $ajUsers[$i]['userEmail']){
      array_push($ajUsers[$i]['Tweets'], $jTweet);
      $sUsers = json_encode($ajUsers, true);
      file_put_contents('users.txt', $sUsers);
      exit();
    }
  }
  header('Content-Type: application/json');
  echo '{"message":'.$jTweet->tweetMessage.'}';
}
catch(Exception $ex){
  echo '{"message":"error '.__LINE__.'"}';
}
