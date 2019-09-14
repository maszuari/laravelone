<template>
  <div>
      <h1>Users</h1>
        <div class="row">
          <div class="col-md-10">
                <form>
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-auto">
                            <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                                <option selected value="true">Active</option>
                                <option value="false">Inactive</option>
                            </select>
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="First name">
                        </div>
                        <div class="col-auto">
                            <input type="text" class="form-control" placeholder="Last name">
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
                    <td>{{ user.status==1?'Active':'Inactive' }}</td>
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
            users: []
        }
    },
    created() {
        let uri = 'http://laravelone.test/api/users';
        this.axios.get(uri).then(response => {
            this.users = response.data.data;
        });
    },
    methods:{
        deleteUser(id, index){
            console.log("id: ", id)
            console.log("index: ", index)
            //TODO : Test this.
            /*let uri = `http://laravelone.test/api/user/delete/${id}`;
            this.axios.delete(uri).then(response => {
                this.users.splice(this.users.indexOf(index), 1);
            });
            */
        }
    }
  }
</script>