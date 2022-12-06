<template>
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit User</h3>
            </div>


            <form @submit.prevent="updateUser">
                <div class="card-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" v-model="form.name" class="form-control" placeholder="Input Name">
                    </div>
                    <!-- {{form.data.name}} -->
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="email" v-model="form.email" class="form-control" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select name="type" v-model="form.type" id="type" class="form-control">
                            <option value="">Select User Role</option>
                            <option value="admin">Admin</option>
                            <option value="user">Standard User</option>
                        </select>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </section>
</template>

<script>
export default {

    data() {
        return {
            form: {
                id: '',
                type: '',
                name: '',
                email: '',
                password: '',
                email_verified_at: '',
            }
        }
    },
    methods: {
        updateUser() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/user/${this.$route.params.id}`;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    this.$router.push({ name: 'user' });
                });
        },
        loadUsers() {

            let uri = `http://localhost:8000/api/user/${this.$route.params.id}`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.form = response.data.data;
                });
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    created() {
        this.loadUsers();
    }

}
</script>