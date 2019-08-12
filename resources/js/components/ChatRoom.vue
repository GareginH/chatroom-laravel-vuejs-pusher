<template>
    <div>
        <div id="chatBox">
            <ul>
                <li v-for="(item, index) in messages" :key="index" class="col">
                    <div v-if="item.user_name===user" class="chat-line-right col-12">{{item.content}}</div>
                    <div v-else-if="item.user_name !== user" class="chat-line-left col-12">
                        <a :href=getLink(item.user_id)>
                            <img :src=getImage(item.user_id) alt="" class="chat-user-image">
                        </a>
                        <a :href=getLink(item.user_id) class="chat-user-name">{{item.user_name}}</a>{{item.content}}
                    </div>
                </li>
            </ul>
        </div>
        <div class="chatbox-form">
            <input type="text" v-model="message.content" id="content" @keyup.enter="postToChat" class="form-control col-10" placeholder="Type your message..." autofocus>
            <button class="btn btn-outline-orange col-2" @click="postToChat">Send</button>
        </div>
    </div>

</template>
<script>
    export default {
        props:['room', 'user'],
        data: function() {
            return  {
                messages: [],
                message:{
                    content:'',
                    chat_id:'',
                    user_name:'',
                    user_id:'',
                }
            }
        },
        mounted() {
            let pusher = new Pusher('CHANGE THIS', {
                cluster: 'eu',
                forceTLS: true
            });
            let channel = pusher.subscribe('CHANGE THIS');
            channel.bind('SendMessage', this.updateChat);
            this.outputChat();
        },

        methods: {
            getImage(value){
                return '/storage/avatars/'+value+"_avatar.jpg";
            },
            getLink(val){
                return '/profile/'+val;
            },
            outputChat()
            {
                axios.get('/chat/get/'+this.room).then(response=>
                {
                    this.messages = response.data;
                })
            },
            updateChat(data){
                let msg = {
                    content:'',
                    chat_id:'',
                    user_name:'',
                    user_id:'',
                };
                msg.content = data.message.content;
                msg.chat_id = data.message.chat_id;
                msg.user_name = data.message.user_name;
                msg.user_id = data.message.user_id;
                this.messages.push(msg);
            },
            postToChat(){
                this.message.chat_id = this.room;
                axios.post('/chat/'+this.room, this.message).then(response=> {});
                this.message = {
                    content:'',
                    chat_id:'',
                    user_name:'',
                    user_id:'',
                };

            },
        },
        updated(){
            let container = this.$el.querySelector('#chatBox');
            container.scrollTop = container.scrollHeight;
        },
        computed:{

        }
    }
</script>
