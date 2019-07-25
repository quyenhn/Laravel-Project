var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var redis = require('redis');

server.listen(process.env.PORT || 6999 , function(){
  console.log("Server dang chay, lang nghe tren cong: " + process.env.PORT || 6999);
});
io.on('connection',function(socket){
    console.log("Xin chao socketid: "+socket.id+' connected');
    var redisClient = redis.createClient();
    redisClient.subscribe('message');

    redisClient.on("message",function(channel, message)
    { 
     console.log("Tin nhan moi: "+ message + " on "+ "channel "+channel);
         socket.emit(channel,message);// server phat tin nhan toi channel
     });

    socket.on('disconnect',function(){
       console.log('Tam biet socketid: '+socket.id+' disconnected');
       redisClient.quit();
   });
});