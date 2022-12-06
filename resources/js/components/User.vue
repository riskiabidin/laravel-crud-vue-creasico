<template>
  <section class="content">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">User List</h3>

            <div class="card-tools">

              <router-link to="/register" class="btn btn-sm btn-primary">
                <i class="fa fa-plus-square"></i>register
              </router-link>
            </div>

          </div>
          <div class="card-body table-responsive p-0">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Type</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Email Verified?</th>
                  <th>Created</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user in users.data" :key="user.id">

                  <td>{{ user.id }}</td>
                  <td>{{ user.type }}</td>
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td></td>
                  <td></td>

                  <td>
                    <router-link :to="`/editUser/${user.id}`">
                      <i class="fa fa-edit blue"></i>
                    </router-link>
                    /
                    <a href="#" @click="deleteUser(user.id)">
                      <i class="fa fa-trash red"></i>
                    </a>

                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="card-footer">
          </div>
        </div>

      </div>
    </div>
  </section>
</template>
  
<script>
export default {
  data() {
    return {
      users: [],
    }
  },
  methods: {
    deleteUser(id) {
      this.axios.delete(`http://localhost:8000/api/user/` + id).
        then(response => {
          console.log(response);
          this.loadUsers();
        });
    },
    loadUsers() {
      let uri = `http://localhost:8000/api/user`;
      this.axios.get(uri).
        then(response => {
          console.log(response.data);
          this.users = response.data;
        });
    },
  },
  mounted() {
    console.log('User Component mounted.')

  },
  created() {
    this.loadUsers();
  }
}
</script>