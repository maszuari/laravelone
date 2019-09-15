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
                            <input type="text" class="form-control" placeholder="First name" v-model="filter.firstname">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Last name" v-model="filter.lastname">
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-success">Search</button>
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
                    <td>{{ user.firstname }}</td>
                    <td>{{ user.lastname }}</td>
                    <td>{{ user.status=='active'?'Active':'Inactive' }}</td>
                    <td><router-link :to="{name: 'edit', params: { id: user.id }}" class="btn btn-primary">Edit</router-link></td>
                    <td><button class="btn btn-danger" @click.prevent="deleteUser(user.id, index)">Delete</button></td>
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
                firstname:'',
                lastname:''
            }
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
                console.log(response.data)
                this.users = response.data;
                console.log('Users ', this.users)
            });
            
        },

        deleteUser(id, index){
            console.log("id: ", id)
            console.log("index: ", index)
            
            let uri = `http://laravelone.test/api/user/delete/${id}`;
            this.axios.delete(uri).then(response => {
                //this.users.splice(index, 1);
                this.$delete(this.users, index)
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