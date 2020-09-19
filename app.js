// MODAL CLOSE AND OPENING
var modalTweet = document.querySelector('#modal-tweet');
var btnModal = document.querySelector('#open-tweet-modal');
btnModal.onclick = function() {
    modalTweet.style.display = 'block'
  }

  function closeModal(){
    modalTweet.style.display = 'none';
  }
  window.onclick = function(event) {
    if (event.target == modalTweet) {
      modalTweet.style.display = "none";
    }
  }


  ////////// POST A TWEET FUNCTION //////////
  async function tweet(){
    var data = new FormData(document.querySelector("#tweetContentModal"))  
    console.log(data) 
    let bridge = await fetch('api-create-tweet.php',{
      "method":"POST",
      "body":data
    }) 
    if(bridge.status != 200){
      console.log('error')
    }
    modalTweet.style.display = 'none';

    renderTweet();
    

    // let sResponse = await bridge.text()
    // let jResponse = JSON.parse(sResponse)
    // console.log(jResponse);
  }

  async function tweetTop(){
    var dataTop = new FormData(document.querySelector("#tweetContentTop") )  ;
    console.log(dataTop) 
    let bridge = await fetch('api-create-tweet.php',{
      "method":"POST",
      "body":dataTop
    }) 
    if(bridge.status != 200){
      console.log('error')
    }
    let sResponse = await bridge.text()
    console.log(sResponse);
    renderTweet();
    

  }

  renderTweet();

  ////////// RENDER TWEET  //////////
  function renderTweet(){
    const interval = setInterval( async function getTweet(){
    let connection = await fetch('api-get-tweets.php')
    // console.log(connection)
    if(connection.status != 200){ alert('Something is wrong in the system') }
    let sjUsers = await connection.text()
    let ajUsers = JSON.parse(sjUsers) // it is the same that PHP json_decode
      for( var i = 0; i < ajUsers.length; i++){
        for( var j = 0 ; j < ajUsers[i].Tweets.length ; j++){
          var divTweet = ` 
        <div class='twittContainer fade-in' }>
        <div class='twitt-profile-picture' ><img src="https://cdn.fastly.picmonkey.com/contentful/h6goo9gw1hh6/2sNZtFAWOdP1lmQ33VwRN3/24e953b920a9cd0ff2e1d587742a2472/1-intro-photo-final.jpg?w=800&q=70" alt="Profile Picture"></div>
          <div class='twitt-content'>
          <div class='twitt-title'>
             <div><strong>${ajUsers[i].userName}</strong></div>
             <div><p>${ajUsers[i].userName}</p></div>
             <div> <form id='buttonDelete' data-tweet-id=${ajUsers[i].Tweets[j].TweetId} onsubmit="deleteTweet(); return false"> <button class='delete-tweet-btn'> <svg viewBox="0 0 24 24" id="trash-can"><path d="M20.746 5.236h-3.75V4.25c0-1.24-1.01-2.25-2.25-2.25h-5.5c-1.24 0-2.25 1.01-2.25 2.25v.986h-3.75c-.414 0-.75.336-.75.75s.336.75.75.75h.368l1.583 13.262c.216 1.193 1.31 2.027 2.658 2.027h8.282c1.35 0 2.442-.834 2.664-2.072l1.577-13.217h.368c.414 0 .75-.336.75-.75s-.335-.75-.75-.75zM8.496 4.25c0-.413.337-.75.75-.75h5.5c.413 0 .75.337.75.75v.986h-7V4.25zm8.822 15.48c-.1.55-.664.795-1.18.795H7.854c-.517 0-1.083-.246-1.175-.75L5.126 6.735h13.74L17.32 19.732z"></path></svg> </button> </div>
               <div id='update-tweet-id' data-tweet-id=${ajUsers[i].Tweets[j].TweetId}> <button onclick='openUpdateModal() '> <svg id='edit-tweet' viewBox="0 0 24 24"><path d="M20.207 8.147c-.39-.39-1.023-.39-1.414 0L12 14.94 5.207 8.147c-.39-.39-1.023-.39-1.414 0-.39.39-.39 1.023 0 1.414l7.5 7.5c.195.196.45.294.707.294s.512-.098.707-.293l7.5-7.5c.39-.39.39-1.022 0-1.413z"></path></svg> </button> </div>
        </div>
            <div id="twitt-text-container">${ajUsers[i].Tweets[j].tweetMessage}</div>
              <div class='button-twitt'>
                <svg id='button-comment' class='button-twitt-bottom' viewBox="0 0 24 24" <g><path d="M14.046 2.242l-4.148-.01h-.002c-4.374 0-7.8 3.427-7.8 7.802 0 4.098 3.186 7.206 7.465 7.37v3.828c0 .108.044.286.12.403.142.225.384.347.632.347.138 0 .277-.038.402-.118.264-.168 6.473-4.14 8.088-5.506 1.902-1.61 3.04-3.97 3.043-6.312v-.017c-.006-4.367-3.43-7.787-7.8-7.788zm3.787 12.972c-1.134.96-4.862 3.405-6.772 4.643V16.67c0-.414-.335-.75-.75-.75h-.396c-3.66 0-6.318-2.476-6.318-5.886 0-3.534 2.768-6.302 6.3-6.302l4.147.01h.002c3.532 0 6.3 2.766 6.302 6.296-.003 1.91-.942 3.844-2.514 5.176z"></path></g></svg>
                <svg id='button-rt' class='button-twitt-bottom' viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-buttonDelete1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><<path d="M23.77 15.67c-.292-.293-.767-.293-1.06 0l-2.22 2.22V7.65c0-2.068-1.683-3.75-3.75-3.75h-5.85c-.414 0-.75.336-.75.75s.336.75.75.75h5.85c1.24 0 2.25 1.01 2.25 2.25v10.24l-2.22-2.22c-.293-.293-.768-.293-1.06 0s-.294.768 0 1.06l3.5 3.5c.145.147.337.22.53.22s.383-.072.53-.22l3.5-3.5c.294-.292.294-.767 0-1.06zm-10.66 3.28H7.26c-1.24 0-2.25-1.01-2.25-2.25V6.46l2.22 2.22c.148.147.34.22.532.22s.384-.073.53-.22c.293-.293.293-.768 0-1.06l-3.5-3.5c-.293-.294-.768-.294-1.06 0l-3.5 3.5c-.294.292-.294.767 0 1.06s.767.293 1.06 0l2.22-2.22V16.7c0 2.068 1.683 3.75 3.75 3.75h5.85c.414 0 .75-.336.75-.75s-.337-.75-.75-.75z"></path></g></svg>
                <svg id='button-like' class='button-twitt-bottom' viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><path d="M12 21.638h-.014C9.403 21.59 1.95 14.856 1.95 8.478c0-3.064 2.525-5.754 5.403-5.754 2.29 0 3.83 1.58 4.646 2.73.814-1.148 2.354-2.73 4.645-2.73 2.88 0 5.404 2.69 5.404 5.755 0 6.376-7.454 13.11-10.037 13.157H12zM7.354 4.225c-2.08 0-3.903 1.988-3.903 4.255 0 5.74 7.034 11.596 8.55 11.658 1.518-.062 8.55-5.917 8.55-11.658 0-2.267-1.823-4.255-3.903-4.255-2.528 0-3.94 2.936-3.952 2.965-.23.562-1.156.562-1.387 0-.014-.03-1.425-2.965-3.954-2.965z"></path></g></svg>
                <svg id='button-send' class='button-twitt-bottom' viewBox="0 0 24 24" class="r-4qtqp9 r-yyyyoo r-1xvli5t r-dnmrzs r-bnwqim r-1plcrui r-lrvibr r-1hdv0qi"><g><path d="M17.53 7.47l-5-5c-.293-.293-.768-.293-1.06 0l-5 5c-.294.293-.294.768 0 1.06s.767.294 1.06 0l3.72-3.72V15c0 .414.336.75.75.75s.75-.336.75-.75V4.81l3.72 3.72c.146.147.338.22.53.22s.384-.072.53-.22c.293-.293.293-.767 0-1.06z"></path><path d="M19.708 21.944H4.292C3.028 21.944 2 20.916 2 19.652V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 .437.355.792.792.792h15.416c.437 0 .792-.355.792-.792V14c0-.414.336-.75.75-.75s.75.336.75.75v5.652c0 1.264-1.028 2.292-2.292 2.292z"></path></g></svg>
              </div>
          </div>
         </div>
         </div>`
         document.querySelector(".middle-btn").insertAdjacentHTML('afterend', divTweet);
      }
    } 
    if (i>= ajUsers.length ) {
      clearInterval(interval)
    }
  }, 2000)
}


  
////////// DELETE TWEET //////////

async function deleteTweet(){
  var btn = event.target
  var tweetId = btn.getAttribute('data-tweet-id')
  // console.log(tweetId)
  var data = new FormData(document.querySelector('#buttonDelete') );
  data.append('tweetId', tweetId);
    var connection = await fetch('api-delete-tweet.php',{
    "method":"POST",
    "body": data
  }) 
  if( connection.status != 200){
    console.log('error');
  }
  let sResponse = await connection.text();
  console.log(sResponse);
  var tweetContainer = btn.parentNode.parentNode.parentNode.parentNode;
  tweetContainer.remove();
  }

////////// OPEN MODAL TO UPDATE //////////
function closeModalUpdate(){
  var modalUpdateTweet = document.querySelector('#update-tweet-modal')
  modalUpdateTweet.style.display = 'none';
}
window.onclick = function(event) {
  var modalUpdateTweet = document.querySelector('#update-tweet-modal')
  if (event.target == modalUpdateTweet) {
    modalUpdateTweet.style.display = "none";
  }
}


function openUpdateModal(){
  btn = event.target
  const tweetIdToUpdate = btn.parentNode.getAttribute('data-tweet-id');
  console.log(tweetIdToUpdate)
  var modalUpdateTweet = document.querySelector('#update-tweet-modal');
  modalUpdateTweet.style.display = 'block';
}
////////// UPDATE TWEET  //////////

async function updateTweet(){
  // var btn = event.target
  var tweetIdSelector = document.querySelector('#update-tweet-id');
  var tweetId = tweetIdSelector.querySelector('#edit-tweet').parentNode.parentNode.getAttribute('data-tweet-id')
  console.log(tweetId)
    var data = new FormData(document.querySelector("#updatedTweet"))
    data.append('tweetId', tweetId);
    let bridgeUpdate = await fetch('api-update-tweet.php',{
      "method":"POST",
      "body":data
    }) 
    let sResponse = await bridgeUpdate.text();
    console.log(sResponse);
    
    // if(bridge.status != 200){
    //   console.log('error')
    // }
    document.querySelector('#update-tweet-modal').style.display = 'none';
    renderTweet();
  }

  


  // const users = ['X', 'Y', 'C', 'D', 'F'];
  // let i = 0;
  // for( i = 0; i < users.length; i++){
  //   const interval = setInterval( () => {
  //     console.log(users[i]);
  //     i+=1
  //     if(i>= users.length){
  //       clearInterval(interval)
  //     }
  //   }, 2000)
  // }





