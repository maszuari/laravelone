<template>
  <div>
    <h1>Create a User</h1>
    <form @submit.prevent="addUser">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="user.email">
            <small v-if="allerros.email" class="form-text text-danger">{{ allerros.email[0] }}</small>
        </div>

         <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" placeholder="Enter first name" v-model="user.first_name">
            <small v-if="allerros.firstname" class="form-text text-danger">{{ allerros.firstname[0] }}</small>
        </div>

        <div class="form-group">
            <label>Last name</label>
            <input type="text" class="form-control" placeholder="Enter last name" v-model="user.last_name">
            <small v-if="allerros.lastname" class="form-text text-danger">{{ allerros.lastname[0] }}</small>
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" v-model="status">
            <label class="form-check-label" for="defaultCheck1">
                Status: {{status?'Active':'Inactive'}}
            </label>
        </div>
         <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
          status:false,
          user:{},
          allerros: []
        }
    },
    methods: {
      addUser(){
        
        if (this.status){
          this.user.status = 'active' 
        }else{
          this.user.status = 'inactive'   
        }
        console.log(this.user);

        let uri = 'http://laravelone.test/api/user/create';
        this.axios.post(uri, this.user).then((response) => {
        this.$router.push({name: 'users'});
        }).catch((error) => {
              //console.log(error.response)
              this.allerros = error.response.data.errors;
              console.log(this.allerros)
              this.success = false;
        });
        
      }
    }
  }
</script>