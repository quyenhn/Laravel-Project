<template>
    <ul class="list-group">
        <li class="list-group-item"  v-for="friend in list_friend">
            <img class="avt-friend" v-bind:src="'/storage/avatars/'+friend.avatar" alt="avatar" style="width:50px;height: 50px;"/>
            {{friend.name}}
            <online-user :friends="friend" :onlineusers="onlineusers"></online-user>
        </li>
    </ul>                
</template>
<script>
    export default {
        props: ['list_friend'],
    }
</script>