<template>
    <div class="feed" ref="feed">
        <ul v-if="contact">
            <li v-for="message in messages" :class="`message${message.to == contact.id ? ' sent' : ' received'}`" :key="message.id">
                <div class="text">
                    {{ message.text }}
                </div>
                <div class="created_at">
                    <small>{{ message.created_at }}</small>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            contact: {
                type: Object
            },
            messages: {
                type: Array,
                required: true
            }
        },
        methods: {
            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 50);
            }
        },
        watch: {
            contact(contact) {
                this.scrollToBottom();
            },
            messages(messages) {
                this.scrollToBottom();
            }
        }
    }
</script>

<style lang="scss" scoped>
.feed {
    background: #f0f0f0;
    height: 100%;
    max-height: 400px;
    overflow: auto;
    ul {
        list-style-type: none;
        padding: 10px;
        li {
            &.message {
                margin: 10px 0px;
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
</style>