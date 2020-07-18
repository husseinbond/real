

    <template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">content</div>

                <div class="card-body">
              <ul class="chat">
        <li class="left clearfix" v-for="post in posts" :key="post.id">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                      
                    </strong>
                </div>
                <h3>
                    {{ post.title }}
                </h3>
                <p v-for="pos in post.comment" :key="pos.id" > name : {{ pos.user.name }} {{ pos.content }} </p>
            </div>

              <form v-on:submit.prevent="sendMessage(post.id)" enctype="multipart/form-data">
                                  

                                    
                                    <div class="form-group">
                                        <input type="text" class="form-control"  v-model="post_content" >
                                  
                                    </div>


                                  
                                    <button type="submit"  class="btn btn-primary">أضافه ردك</button>
                                       
                                </form>

        </li>
    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


  
</template>

<script>
    export default {
         props: ['me'],
          data() {
            return {
                posts:[],
                post_content:'',

            }
        },

       mounted(){

  axios.get('/getdata')
  .then((res) => {
                
console.log(res.data)
this.posts = res.data

                })

    Echo.private('comment.'+ localStorage.getItem('uID')).listen('.commentd',
    (e) => {

 axios.get('/getdata')
  .then((res) => {
                
console.log(res.data)
this.posts = res.data

                })
});


  },

      

        methods: {
             sendMessage(id) {
               axios.post('/comments', {
                    post_id: id,
                  
                    post_content: this.post_content
                });

                this.post_content = ''
            },




        },




    }
</script>