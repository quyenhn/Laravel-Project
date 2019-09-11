// /*var app = require('express')();
// var server = require('http').Server(app);
// var io = require('socket.io')(server);
// var redis = require('redis');
// const port=process.env.PORT || '6999';
// server.listen( port , function(){
//   console.log("Server dang chay, lang nghe tren cong: " + port);
// });
// io.on('connection',function(socket){
//     console.log("Xin chao socketid: "+socket.id+' connected');
//     var redisClient = redis.createClient();
//     redisClient.subscribe('message');

//     redisClient.on("message",function(channel, message)
//     { 
//      console.log("Tin nhan moi: "+ message + " on "+ "channel "+channel);
//          socket.emit(channel,message);// server phat tin nhan toi channel
//      });

//     socket.on('disconnect',function(){
//        console.log('Tam biet socketid: '+socket.id+' disconnected');
//        redisClient.quit();
//    });
//  });*/

//  var app = require('express')();
//  var server = require('http').Server(app);
//  var io = require('socket.io')(server);
//  var redis = require('redis');
//  server.listen(6999);
//  var users = {};

//  var redisClient = redis.createClient();
//  redisClient.subscribe('message');

//  redisClient.on("message", function(channel, data) {
//   var data = JSON.parse(data); 
//   console.log('--------mess-------',data);
// //io.emit('message',data);
// /*users[data.to].emit("message",{to:data.to,from:data.from,msg:data.text});
// users[data.from].emit("message", {to:data.to,from:data.from,msg:data.text});*/

// });

//  io.on('connection', function (socket) {
//   console.log("Xin chao socketid: "+socket.id+' connected');
//   socket.on("message",function (data) {
//     socket.from=data.from;
//     socket.to=data.to;
//     users[data.to]=socket;
//     users[data.from]=socket;
//   });

//   socket.on('disconnect', function() {
//     redisClient.quit();
//     console.log('Tam biet socketid: '+socket.id+' disconnected');
//     // if(!(socket.user_id in users)) return;
//     // if(!(socket.conversation_id in users[socket.user_id])) return;

//     // delete users[socket.user_id][socket.conversation_id];
//     // if(Object.keys(users[socket.user_id]).length === 0){
//     //   delete users[socket.user_id];
//     // }
//   });
// }); 
'use strict';

const express = require('express');
const http = require('http');
const socketio = require('socket.io');
const socketEvents = require('./utils/socket');

class Server {
  constructor() {
    this.port = process.env.PORT || 3000;
        this.host = process.env.HOST || `localhost`;

        this.app = express();
        this.http = http.Server(this.app);
        this.socket = socketio(this.http);
  }

  appRun(){
    new socketEvents(this.socket).socketConfig();
    this.app.use(express.static(__dirname + '/uploads'));
        this.http.listen(this.port, this.host, () => {
            console.log(`Listening on http://${this.host}:${this.port}`);
        });
    }
}

const app = new Server();
app.appRun();
