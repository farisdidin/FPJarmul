var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var path = require('path');
 
// Initialize appication with route / (that means root of the application)
app.get('/', function(req, res){
  var express=require('express');
  app.use(express.static(path.join(__dirname)));
  console.log(__dirname);
  res.sendFile(path.join(__dirname, '../TChat', 'index.html'));
});

var usernames = {};

var rooms = ['room1','room2','room3','room4'];

 
// Register events on socket connection
io.on('connection', function(socket){ 
  socket.on('adduser',function(username,classroom){
    console.log(username);
    socket.username = username;
    socket.room = classroom;
    usernames[username] = username;
    socket.join(classroom);
    socket.emit('updatechat','SERVER','you have connected to '+classroom);
    socket.broadcast.to(classroom).emit('updatechat','SERVER', username + ' has connected to '+ classroom);
    socket.emit('updaterooms',rooms,classroom);
  })
  socket.on('sendchat', function(data){
    console.log(data);
    io.sockets.in(socket.room).emit('updatechat',socket.username, data);
  })
    socket.on('switchRoom', function(newroom){
    socket.leave(socket.room);
    socket.join(newroom);
    socket.emit('updatechat', 'SERVER', 'you have connected to '+ newroom);
    // sent message to OLD room
    socket.broadcast.to(socket.room).emit('updatechat', 'SERVER', socket.username+' has left this room');
    // update socket session room title
    socket.room = newroom;
    socket.broadcast.to(newroom).emit('updatechat', 'SERVER', socket.username+' has joined this room');
    socket.emit('updaterooms', rooms, newroom);
  });
  socket.on('disconnect', function(){
    // remove the username from global usernames list
    delete usernames[socket.username];
    // update list of users in chat, client-side
    io.sockets.emit('updateusers', usernames);
    // echo globally that this client has left
    socket.broadcast.emit('updatechat', 'SERVER', socket.username + ' has disconnected');
    socket.leave(socket.room);
  });

  socket.on('notifyUser', function(user){
    //io.emit('notifyUser', user);
    io.sockets.in(socket.room).emit('notifyUser',socket.username);

  });
});
 
// Listen application request on port 3000
http.listen(3000, function(){
  console.log('listening on *:3000');
});
