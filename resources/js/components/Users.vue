<template>
  <div>
        <div class="row">
            <div class="col-md-10">
                <h1>Users</h1>
            </div> 
            <div class="col-md-2">
                <button class="btn btn-secondary" @click.prevent="showAllUsers()">Show all users</button>
            </div>   
        </div>
        <div class="row">
          <div class="col-md-10">
                <form @submit.prevent="filterUsers">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <input type="email" class="form-control" placeholder="Email" v-model="filter.email">
                        </div>
                        <div class="col-auto">
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" v-model="filter.status">
                                <option selected value="none">None</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="First name" v-model="filter.first_name">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Last name" v-model="filter.last_name">
                        </div>
                        <div class="col-auto">
                            <button v-if="loadingFilter" class="btn btn-success" disabled>Loading...</button>
                            <button v-else class="btn btn-success">Search</button>
                        </div>
                    </div>
                </form>
          </div>
          <div class="col-md-2">
            <router-link :to="{ name: 'create' }" class="btn btn-primary">Create User</router-link>
          </div>
        </div><br />

        <table class="table table-hover">
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in users" :key="user.id">
                    <td>{{ user.id }}</td>
                    <td>{{ user.email }}</td>
                    <td>{{ user.first_name }}</td>
                    <td>{{ user.last_name }}</td>
                    <td>{{ user.status=='active'?'Active':'Inactive' }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button v-if="loadingDelete" class="btn btn-danger" disabled>Loading...</button>
                        <button v-else class="btn btn-danger" @click.prevent="deleteUser(user.id, index)">Delete</button></td>
                </tr>
            </tbody>
        </table>
  </div>
</template>

<script>
  export default {
    data() {
        return {
            users: [],
            filter:{
                email:'',
                status:'none',
                first_name:'',
                last_name:''
            },
            loadingDelete:false,
            loadingFilter:false
        }
    },
    created() {
        let uri = 'http://laravelone.test/api/users';
        this.axios.get(uri).then(response => {
            this.users = response.data.data;
        });
    },
    methods:{
        filterUsers(){
            console.log(this.filter)
            this.loadingFilter = true;
            let queryStringParts = new Array();
            for(var key in this.filter) {

                if( key === 'status' && this.filter[key] !== 'none'){
                    console.log('Add on status ', this.filter[key] )
                    queryStringParts.push(key + '=' + this.filter[key]);
                    continue;
                }
                if ( key !== 'status' && this.filter[key].trim().length > 0 ){
                    console.log('Add other ', this.filter[key] )
                    queryStringParts.push(key + '=' + this.filter[key]);
                }
                
            }
            let queryString = queryStringParts.join('&');
            let uri = 'http://laravelone.test/api/users/filter?'+queryString;
            console.log('URI ', uri);

            this.axios.get(uri).then(response => {
                this.loadingFilter = false;
                this.users = response.data;
                console.log('Users ', this.users)
            }).catch((error) => {
                //console.log(error.response)
                this.loadingFilter = false;
          });
            
        },

        deleteUser(id, index){
            console.log("id: ", id)
            console.log("index: ", index)
            this.loadingDelete = true;
            let uri = `http://laravelone.test/api/user/delete/${id}`;
            this.axios.delete(uri).then(response => {
                //this.users.splice(index, 1);
                this.$delete(this.users, index)
                this.loadingDelete = false;
            }).catch((error) => {
                //console.log(error.response)
                this.loadingDelete = false;
          });
            
        },

        showAllUsers(){
            let uri = 'http://laravelone.test/api/users';
            this.axios.get(uri).then(response => {
                this.users = response.data.data;
            });
        }
    }
  }

</script>