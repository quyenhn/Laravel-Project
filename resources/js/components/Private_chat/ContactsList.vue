<template>
    <div class="contacts-list">
        <input type="text" v-model="search" class="form-control" placeholder="Search user">
        <ul>
            <li @click.prevent="selectContact(contact)" :class="{'selected':contact==selected}" :key="contact.id" v-for="contact in sortedContacts">
                <div class="avatar">
                    <img :src="'/storage/avatars/'+ contact.avatar" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                    <p class="email">{{ contact.email }}</p>
                </div>
                <small><i aria-hidden="true" class="fa fa-circle pull-right text-success" style="margin: 0;position: absolute;top: 50%;right: 0%;transform: translate(-50%, -50%);" v-if="onlineUser(contact.id)"></i></small>

                <!-- <div class="status" style="color:#fff">
                  <div  v-if="onlineUser(contact.id) || online.id==contact.id" >
                      <i class="fa fa-circle pull-right text-success"></i>
                  </div>
                  <div v-else>
                      <i  class="fa fa-circle pull-right text-danger"></i> offline
                  </div>
              </div> -->
              
              <span class="unread" v-if="contact.unread">{{ contact.unread }}</span>
          </li>
          <li v-show="contacts.length === 0" disabled>No contacts found</li>
      </ul>
  </div>
</template>

<script>
    export default {
        props: {
            contacts: {
                type: Array,
                default: []
            }

        },

        mounted(){
            Echo.join(`messages`)
            .here((users) => {
              this.users = users;
              
          })
            .joining((user) => {
                // this.online = user;
                this.user = user;
                this.users.push(user);
            })
            .leaving((user) => {
                console.log(user.name+" leave chat");
                this.users = this.users.filter(u => u != user);
                // this.online=''
            });
        },

        data() {
            return {
                selected: this.contacts.length ? this.contacts[0] : null,
                search:'',

                users:[],
                online:'',
            };
        },
        methods: {
            selectContact(contact) {
                this.selected = contact;
                this.$emit('selected', contact);
                
            },    
            onlineUser(userId){
                return _.find(this.users,{'id':userId});
            }   
        },
        computed: {
            sortedContacts() {
                if(this.search){
                    return this.contacts.filter((contact)=>
                    {
                        return contact.name.match(this.search);
                    })
                }
                return _.sortBy(this.contacts, [(contact) => {
                    /*if (contact == this.selected) {
                        return Infinity;
                    }*/
                    return contact.unread;
                }]).reverse();
            },
        },

       /* created() {
            Echo.join(`messages`)
            .here(users => {
                this.contacts.forEach(contact => {
                  users.forEach(user => {
                    if (user.id == contact.id) {
                      contact.online = true;
                  }
              });
              });
            })
            .joining(user => {
                this.contacts.forEach(
                  contact => (user.id == contact.id ? (contact.online = true) : "")
                  );
            })
            .leaving(user => {
                this.contacts.forEach(
                  contact => (user.id == contact.id ? (contact.online = false) : "")
                  );
            });
        },*/

    }
</script>

<style lang="scss" scoped>
.contacts-list {
    flex: 2;
    max-height: 550px;
    overflow: auto;
    border-right: 1px solid #a6a6a6;
    
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
            &.selected {
                background: #dfdfdf;
            }
            span.unread {
                background: #82e0a8;
                color: #fff;
                position: absolute;
                right: 20px;
                top: 30px;
                display: flex;
                font-weight: 700;
                min-width: 20px;
                justify-content: center;
                align-items: center;
                line-height: 20px;
                font-size: 12px;
                padding: 0 4px;
                border-radius: 5px;
            }
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
                overflow: hidden;
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
}
</style>