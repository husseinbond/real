
<template>
<div>
  

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">content</div>

                <div class="card-body">
              <ul class="chat">
        <li class="left clearfix" v-for="message in messages" :key="message.id">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                      
                    </strong>
                </div>
                <h3>
                    {{ message.name }}
                </h3>
                <p > unRead Message : {{ message.unread }}</p>
            </div>
        </li>
    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">notification Message</div>

                <div class="card-body">
                  <ul class="chat">
        <li class="left clearfix" v-for="notification in notifications" :key="notification.id">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                      
                    </strong>
                </div>
                <h6 >
                message:  {{notification.msg.message}}
                </h6>
    <p >
             from:     {{notification.sender.name}}
                </p>

            </div>
        </li>
    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



  



 
</div>
</template>

<script>
  export default {
    data() {
        return {
            messages: [],
            notifications:[]
        }
    },


mounted(){

  axios.get('/chat')
  .then((res) => {
                    this.messages = res.data

                })

  axios.get('/ntf')
  .then((res) => {
                    this.notifications = res.data

                })



    Echo.private('chat.'+ localStorage.getItem('uID')).listen('.chat',
    (e) => {




    axios.get('/chat')
  .then((res) => {
                    this.messages = res.data

                })


    axios.get('/ntf')
  .then((res) => {
                    this.notifications = res.data

                })


});
  }
  }

</script>