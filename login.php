<?php
    session_start();
    if(  $_SESSION ) {
        header('Location: index.php');
    exit();
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twitter || Login</title>
    <link rel="stylesheet" href="login.css">
    <link rel="icon" href="https://icons.iconarchive.com/icons/danleech/simple/256/twitter-icon.png">
</head>
<body>
    <div id='page'>
        <div class='left'>
            <img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/f223ce72-c7cd-46e7-915b-40d3af21f6b7/d5gityo-321176dd-a6d4-4546-aa65-cc41d33562b7.png?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3sicGF0aCI6IlwvZlwvZjIyM2NlNzItYzdjZC00NmU3LTkxNWItNDBkM2FmMjFmNmI3XC9kNWdpdHlvLTMyMTE3NmRkLWE2ZDQtNDU0Ni1hYTY1LWNjNDFkMzM1NjJiNy5wbmcifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6ZmlsZS5kb3dubG9hZCJdfQ.8kc3cErcA2AGqLUnTQO2mJD7ZOO5AjsHAGezow7f4as" alt="">
        </div>
        <div class="right">
            <div class='right-one'></div>
            <div class='right-two'>
                <div class='form-container-login'> <form id='form-login-top-btn' action="login-action.php" method='POST'> <input name='email' type="text" placeholder='Email'> <input name='password' type="password" placeholder="Password"> </form></div>
                <div class='forgot-link'> <a href="#"> Forgot your password?</a></div>
                <div class='tw-icon'><svg viewBox="0 0 24 24" class="r-k200y r-13gxpu9 r-4qtqp9 r-yyyyoo r-np7d94 r-dnmrzs r-bnwqim r-1plcrui r-lrvibr"><g><path d="M23.643 4.937c-.835.37-1.732.62-2.675.733.962-.576 1.7-1.49 2.048-2.578-.9.534-1.897.922-2.958 1.13-.85-.904-2.06-1.47-3.4-1.47-2.572 0-4.658 2.086-4.658 4.66 0 .364.042.718.12 1.06-3.873-.195-7.304-2.05-9.602-4.868-.4.69-.63 1.49-.63 2.342 0 1.616.823 3.043 2.072 3.878-.764-.025-1.482-.234-2.11-.583v.06c0 2.257 1.605 4.14 3.737 4.568-.392.106-.803.162-1.227.162-.3 0-.593-.028-.877-.082.593 1.85 2.313 3.198 4.352 3.234-1.595 1.25-3.604 1.995-5.786 1.995-.376 0-.747-.022-1.112-.065 2.062 1.323 4.51 2.093 7.14 2.093 8.57 0 13.255-7.098 13.255-13.254 0-.2-.005-.402-.014-.602.91-.658 1.7-1.477 2.323-2.41z"></path></g></svg></div>
                <div> <h1>See what's happening in the world right now</h1></div>
                <div> <h4>Join Twitter today</h4></div>
                <div class='button-signup'><a href="signup.php"><button> Sign Up</button></div></a>
                <div class='button-login'> <a href="loginPage.php"><button> Log in </button></a></div>

                
            </div>
            <div class='right-three'>
                <button type='submit' form='form-login-top-btn'> Log In</button></div>
        </div>
        <div class="footer"></div>









    </div>
    
</body>
</html>