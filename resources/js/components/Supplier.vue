<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">supplier List</h3>

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
                        <th scope="col">Nama supplier</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Telepon</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="supplier in suppliers.data" :key="supplier.id">
                        <th scope="row">{{ supplier.id }}</th>
                        <td>{{ supplier.name_supplier }}</td>
                        <td>{{ supplier.alamat }}</td>
                        <td>{{ supplier.telepon }}</td>
                        <td>
                            <a href="#" @click="editSupplier(supplier.id)">
                                <i class="fa fa-edit blue"></i>
                            </a>
                            /
                            <a href="#" @click="deleteSupplier(supplier.id)">
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
                        <h1 class="modal-title fs-5" id="addNewLabel">supplier</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateSupplier() : createSupplier()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name supplier:</label>
                                    <input v-model="form.name_supplier" type="text" class="form-control"
                                        placeholder="Input Name supplier">
                                    <div class="text-danger" v-if="errors.name_supplier">{{ errors.name_supplier }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Alamat:</label>
                                    <input v-model="form.alamat" type="text" class="form-control"
                                        placeholder="Input alamat supplier">
                                    <div class="text-danger" v-if="errors.alamat">{{ errors.alamat }}</div>
                                </div><div class="form-group">
                                    <label>Telepon:</label>
                                    <input v-model="form.telepon" type="text" class="form-control"
                                        placeholder="Input Name supplier">
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
            suppliers: [],
            form: {
                id: '',
                name_supplier: '',
                alamat:'',
                telepon:''
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
        createSupplier() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/supplier`;
            this.axios.post(uri, this.form).
                then(response => {
                    console.log(response.data);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadSuppliers();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        editSupplier(id) {
            this.axios.get(`http://localhost:8000/api/supplier/` + id).
                then(response => {
                    console.log(response);
                    this.editmode = true;
                    this.errors={};
                    this.form = response.data.data;
                    $('#addNew').modal('show');
                });
        },
        updateSupplier() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/supplier/` + this.form.id;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadSuppliers();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        deleteSupplier(id) {
            this.axios.delete(`http://localhost:8000/api/supplier/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadSuppliers();
                });
        },
        loadSuppliers() {
            let uri = `http://localhost:8000/api/supplier`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.suppliers = response.data;
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
        this.loadSuppliers();
    }
}
</script>