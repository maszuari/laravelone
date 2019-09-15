<template>
  <div>
    <h1>Edit a User</h1>
    <form @submit.prevent="updateUser">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" placeholder="Enter email" v-model="user.email">
            <small v-if="allerros.email" class="form-text text-danger">{{ allerros.email[0] }}</small>
        </div>

         <div class="form-group">
            <label>First name</label>
            <input type="text" class="form-control" placeholder="Enter first name" v-model="user.first_name">
            <small v-if="allerros.first_name" class="form-text text-danger">{{ allerros.first_name[0] }}</small>
        </div>

        <div class="form-group">
            <label>Last name</label>
            <input type="text" class="form-control" placeholder="Enter last name" v-model="user.last_name">
             <small v-if="allerros.last_name" class="form-text text-danger">{{ allerros.last_name[0] }}</small>
        </div>

        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" v-model="status">
            <label class="form-check-label" for="defaultCheck1">
                Status: {{status?'Active':'Inactive'}}
            </label>
        </div>
        <button v-if="loading" type="submit" class="btn btn-primary" disabled>Loading...</button>
        <button v-else type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>
</template>

<script>
    export default {
        data(){
        return {
            status:false,
            user:{},
            allerros: [],
            loading: false
        }
    },
    created(){
        let uri = `http://laravelone.test/api/user/edit/${this.$route.params.id}`;
        this.axios.get(uri).then((response) => {
            this.user = response.data;
            this.status = this.user.status === 'active'? true:false;
        });

    },
    methods: {
        updateUser() {
            this.loading = true;
            this.user.status = this.status===true?'active':'inactive';
            console.log(this.user)

            let uri = `http://laravelone.test/api/user/update/${this.$route.params.id}`;
            this.axios.post(uri, this.user).then((response) => {
                this.loading = false;
                this.$router.push({name: 'users'});
            }).catch((error) => {
                //console.log(error.response)
                this.loading = false;
                this.allerros = error.response.data.errors;
                console.log(this.allerros)
          });
        }
    }
  }
</script>