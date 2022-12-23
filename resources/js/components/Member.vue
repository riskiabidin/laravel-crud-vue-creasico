<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">member List</h3>

            <div class="card-tools">

                <button class="btn btn-sm btn-primary" @click="newModal">
                    <i class="fa fa-plus-square"></i>Create
                </button>
            </div>

        </div>
        <div class="card-body ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">kode member</th>
                        <th scope="col">Nama member</th>
                        <th scope="col">alamat</th>
                        <th scope="col">telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="member in Members.data" :key="member.id">
                        <th scope="row">{{ member.id }}</th>
                        <td>{{ member.kode_member }}</td>
                        <td>{{ member.nama }}</td>
                        <td>{{ member.alamat }}</td>
                        <td>{{ member.telepon }}</td>
                        <td>
                            <a href="#" @click="editMember(member.id)">
                                <i class="fa fa-edit blue"></i>
                            </a>
                            /
                            <a href="#" @click="deleteMember(member.id)">
                                <i class="fa fa-trash red"></i>
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNew" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addNewLabel">member</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateMember() : createMember()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>kode member:</label>
                                    <input v-model="form.kode_member" type="text" class="form-control"
                                        placeholder="Input kode member">
                                    <div class="text-danger" v-if="errors.kode_member">{{ errors.kode_member }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input v-model="form.nama" type="text" class="form-control"
                                        placeholder="Input Name member">
                                    <div class="text-danger" v-if="errors.nama">{{ errors.nama }}</div>
                                </div>

                                <div class="form-group">
                                    <label>alamat:</label>
                                    <input v-model="form.alamat" type="text" class="form-control"
                                        placeholder="Input alamat">
                                    <div class="text-danger" v-if="errors.alamat">{{ errors.alamat }}</div>
                                </div>

                                <div class="form-group">
                                    <label>telepon:</label>
                                    <input v-model="form.telepon" type="number" class="form-control"
                                        placeholder="Input number telepon">
                                    <div class="text-danger" v-if="errors.telepon">{{ errors.telepon }}</div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </div>
                        </form>
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
            editmode: false,
            Members: [],
            form: {
                id: '',
                nama: '',
            },
            errors:{}
        }
    },
    methods: {
        newModal() {
            this.editmode = false;
            // this.form.reset();
            this.errors={};
            $('#addNew').modal('show');
        },
        createMember() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/member`;
            this.axios.post(uri, this.form).
                then(response => {
                    console.log(response.data);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadMembers();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        editMember(id) {
            this.axios.get(`http://localhost:8000/api/member/` + id).
                then(response => {
                    console.log(response);
                    this.editmode = true;
                    this.errors={};
                    this.form = response.data.data;
                    $('#addNew').modal('show');
                });
        },
        updateMember() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/member/` + this.form.id;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadMembers();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        deleteMember(id) {
            this.axios.delete(`http://localhost:8000/api/member/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadMembers();
                });
        },
        loadMembers() {
            let uri = `http://localhost:8000/api/member`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.Members = response.data;
                });
                this.form={};
                this.errors={};
                this.editmode=false;
        },
    },
    mounted() {
        console.log('User Component mounted.')

    },
    created() {
        this.loadMembers();
    }
}
</script>