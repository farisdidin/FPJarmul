// var socket = io.connect("http://riset.ajk.if.its.ac.id/",{path: '/TChat'});
var socket = io()/*.connect(("http://riset.ajk.if.its.ac.id/", 3000);*/
function submitfunction(){
  var from = $('#user').val();
  var message = $('#m').val();
  if(message != '') {
  socket.emit('sendchat',message);
}
$('#m').val('').focus();
  return false;
}
 
function notifyTyping() { 
  var user = $('#user').val();
  socket.emit('notifyUser', user);
}

function switchRoom(room){
    socket.emit('switchRoom', room);
  }

socket.on('updaterooms', function(rooms, current_room) {
  $('#rooms').empty();
  $.each(rooms, function(key, value) {
    if(value == current_room){
      $('#rooms').append('<div>' + value + '</div>');
    }
    else {
      $('#rooms').append('<div><a href="#" onclick="switchRoom(\''+value+'\')">' + value + '</a></div>');
    }
  });
});

socket.on('updatechat', function (username, data) {
  var me = $('#user').val();
  var color = (username == me) ? 'green' : '#009afd';
  var username = (username == me) ? 'Me' : username;
  $('#messages').append('<li><b style="color:' + color +'">' + username + ':</b> ' + data + '</li>');
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
  console.log("document ready");
  makeid();
  
});
 
  function makeid(){
    console.log('make id')
    window.addEventListener('message', function(event) {
      // alert(`Received ${event.data} from ${event.origin}`);
      // console.log (event.data);
      var name = event.data;
      console.log('message')
      $('#user').val(event.data);
      socket.emit('adduser',event.data);
      //return event.data;
      $
    });
  }

