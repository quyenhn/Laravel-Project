<template>
    <div class="composer input-group">
        <textarea class="form-control" v-model="message" @keydown.enter="send" placeholder="Type your message here..."></textarea>
        <button class="btn btn-success btn-sm" @click="send"><i class="fa fa-paper-plane" aria-hidden="true"></i> Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: ''
            };
        },
        methods: {
            send(e) {
                e.preventDefault();
                
                if (this.message == '') {
                    return alert('Please enter message');
                }
                this.$emit('send', this.message);
                this.message = '';
            }
        }
    }
</script>

<style lang="scss" scoped>
.composer textarea {
   /* width: 96%;*/
    margin: 10px;
    resize: none;
    border-radius: 3px;
    border: 1px solid lightgray;
    padding: 6px;
}
.composer button{
    margin:10px;
    margin-left:0px;
}
</style>