<template>
  <div class="col-md-9">
   <div class="card">
    <div class="card-header">
      Chat toàn server
    </div>
    <div class="card-body feed" ref="feed">
      <ul  v-if='messages && messages.length' style="padding: 0px;margin: 0px;">
        <li  v-for='message in messages' :key='message.id' :class="`message${message.from==$userId ?' sent' : ' received'}`">
        <!-- <div class="media-body"> -->
          <img :src="'/storage/avatars/'+ message.avatar" :alt="message.name" class="avatar">
          <small><span style="color:red;"><strong>{{message.name}}</strong></span></small><br>
          <div class="text">{{message.text}}</div><br>
          <small>{{message.created_at}}</small>
        <!-- </div> -->
      </li>
    </ul>
    <div class="messages-not-found" v-else>Messages not found</div>
  </div>
  <div class="card-footer">
    <div style="display:flex;" class="input-group">
      <textarea class="form-control" placeholder="type your chat" v-model='message' @keyup.enter="sendMessage"></textarea>
      <button class="btn btn-success btn-sm" @click="sendMessage"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
    </div>
  </div>
</div>
</div>  
</template>

<script>
  export default {
    data(){
      return {
        messages:[],
        message:'',
        name:$('.dropdown .dropdown-toggle').text()
      }
    },
    sockets:{
      connect:function(){
        console.log('Socket Connected')
      },
      message:function(val){
       this.getMessage();
     }
   },
   methods:{
    sendMessage(){
      axios.post('/sendMessage',{text:this.message})
      .then(response=>{
        console.log(response);
      });
      this.messages.push();
      this.message='';
    },
    getMessage(){
     axios.get('/messages')
     .then(response=>{
      console.log(response);
      this.messages = response.data;
    });

   },
   scrollToBottom() {
    setTimeout(() => {
      this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
    }, 50);
  }
},
watch: {
  messages(messages) {
    this.scrollToBottom();
  }
},
mounted() {
 this.getMessage();
}
}
</script>
<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    max-height: 400px;
    overflow: auto;
    ul {
        list-style-type: none;
        li {
            &.message {
                margin: 0px;
                width: 100%;
                .text {
                    max-width: 600px;
                    border-radius: 15px;
                    padding: 12px;
                    display: inline-block;
                }
                &.received {
                    text-align: left;
                    .text {
                        background: #b2b2b2;
                    }
                }
                &.sent {
                    text-align: right;
                    .text {
                        background: #81c4f9;
                    }
                }
            }
        }
    }
}
.avatar {
  width: 20px;
  border-radius: 50%;
  display:none;
}

.card-footer textarea {
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
.card-footer button{
    margin:10px;
    margin-left:0px;
}
</style>