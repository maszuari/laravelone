<template>
  <div>
    <h1>Edit a User</h1>
    <form @submit.prevent="updateUser">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="user.email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>

         <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" placeholder="Enter first name" v-model="user.firstname">
        </div>

        <div class="form-group">
            <label>Last name</label>
            <input type="text" class="form-control" placeholder="Enter last name" v-model="user.lastname">
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" v-model="user.status">
            <label class="form-check-label" for="defaultCheck1">
                Status: {{user.status?'Active':'Inactive'}}
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
          user:{},
          allerros: []
        }
    },
    created(){
        let uri = `http://laravelone.test/api/user/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.user = response.data;
        });

    },
    methods: {
        updateUser() {
            let uri = `http://laravelone.test/api/user/update/${this.$route.params.id}`;
            this.axios.post(uri, this.user).then((response) => {
                this.$router.push({name: 'users'});
            }).catch((error) => {
                //console.log(error.response)
                this.allerros = error.response.data.errors;
                console.log(this.allerros)
          });
        }
    }
  }
</script>