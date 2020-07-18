<template>
    <div class="input-group">
           <form v-on:submit.prevent="sendMessage()" enctype="multipart/form-data">
        <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." @click="readMessage" v-model="newMessage" @keyup.enter="sendMessage">

        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary btn-sm" id="btn-chat" >
                Send
            </button>
        </span>
           </form>
    </div>
</template>

<script>
    export default {
        props: ['from','to'],

        data() {
            return {
                newMessage: ''
            }
        },

        methods: {
            sendMessage() {
               axios.post('/sender', {
                    to_user_id: this.to,
                     from_user_id: this.from,
                    message: this.newMessage
                });

                this.newMessage = ''
            },


readMessage(){
console.log(1);
}



        }    
    }
</script>