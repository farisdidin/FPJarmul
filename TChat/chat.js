// var socket = io.connect("http://riset.ajk.if.its.ac.id/",{path: '/TChat'});
var socket = io()/*.connect(("http://riset.ajk.if.its.ac.id/", 3000);*/
function submitfunction(){
  var from = $('#user').val();
  var message = $('#m').val();
  if(message != '') {
  socket.emit('chatMessage', from, message);
}
$('#m').val('').focus();
  return false;
}
 
function notifyTyping() { 
  var user = $('#user').val();
  socket.emit('notifyUser', user);
}
 
socket.on('chatMessage', function(from, msg){
  var me = $('#user').val();
  var color = (from == me) ? 'green' : '#009afd';
  var from = (from == me) ? 'Me' : from;
  $('#messages').append('<li><b style="color:' + color + '">' + from + '</b>: ' + msg + '</li>');
  $("html, body").animate({ scrollTop: $(document).height() }, "slow");
});
 
socket.on('notifyUser', function(user){
  var me = $('#user').val();
  if(user != me) {
    $('#notifyUser').text(user + ' is typing ...');
  }
  setTimeout(function(){ $('#notifyUser').text(''); }, 10000);;
});
 
$(document).ready(function(){
  // console.log("document ready");
  makeid();
  
});
 
// function makeid() {
//   var text = prompt ("Welcome to TChatting !!\n---- Insert Username ---");
//   if (text=="") {
//   var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
 
//   for( var i=0; i < 5; i++ ) {
//     text += possible.charAt(Math.floor(Math.random() * possible.length));
//   }
//   }
//   return text;
// }
  function makeid(){
    console.log('make id')
    window.addEventListener('message', function(event) {
      // alert(`Received ${event.data} from ${event.origin}`);
      // console.log (event.data);
      var name = event.data;
      $('#user').val(event.data);
      socket.emit('chatMessage', 'System', '<b>' + event.data + '</b> has joined the discussion');
      //return event.data;
      $
    });
  }

