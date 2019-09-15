<template>
  <div class="row justify-content-center">
      <div class="col-md-8 text-center">
         <p>This is a demo of CRUD project that uses Vue.js, Laravel and MySQL.</p>
         <p>To begin, simply click one of below buttons</p>
         <p><router-link :to="{ name: 'create' }" class="btn btn-primary">Create User</router-link> 
          <router-link :to="{ name: 'users' }" class="btn btn-secondary">Show All Users</router-link></p>
          <p class="text-monospace">Developed by: <a href="https://www.linkedin.com/in/maszuari/" target="_blank">Maszuari</a></p>
      </div>
  </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>