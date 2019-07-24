<template>
 <div class="col-md-3">
   <div class="card">
    <div class="card-header">
      List users logged in the blog
    </div>
    <div class="card-body ">
      <!-- <h5 class="card-title">User List</h5> -->
      <ul>
        <li :key="user.id" v-for="user in users">
          <div class="avatar">
            <img :src="'/storage/avatars/'+ user.avatar" :alt="user.name">
          </div>
          <div class="contact">
            <p class="name">{{ user.name }}</p>
            <p class="email">{{ user.email }}</p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
</template>

<script>
  export default {
       data() {
            return {
                users: []
            }
        },
         mounted(){
          axios.get('/getAllUser')
            .then((response) => {
                this.users = response.data;
            });          
         }
  }
</script>
<style lang="scss" scoped>
.col-md-3{
  max-height: 550px;
  overflow: auto;
}
.card-body{
  padding:0px;
}
ul { 
        list-style-type: none;
        padding-left: 0px;
        li {
            display: flex;
            padding: 2px;
            /*border-bottom: 1px solid #aaaaaa;*/
            border-bottom: 1px dashed lightgray;
            height: 80px;
            position: relative;
            cursor: pointer;
           
            .avatar {
                flex: 1;
                display: flex;
                align-items: center;
                img {
                    width: 35px;
                    border-radius: 50%;
                    margin: 0 auto;
                }
            }
            .contact {
                flex: 3;
                font-size: 10px;
                overflow: auto;
                display: flex;
                flex-direction: column;
                justify-content: center;
                p {
                    margin: 0;
                    &.name {
                        font-weight: bold;
                    }
                }
            }
        }
    }
</style>