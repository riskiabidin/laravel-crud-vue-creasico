<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">pembelian List</h3>

            <div class="card-tools">

                <router-link to="/insert_pembelian" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-square"></i>Create Pembelian
                </router-link>
            </div>

        </div>
        <div class="card-body ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Supplier</th>
                        <th scope="col">Total Pembelian</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="pembelian in pembelians.data" :key="pembelian.id">
                        <th scope="row">{{ pembelian.id }}</th>
                        <td>{{ pembelian.supplier.name_supplier }}</td>
                        <td>{{ pembelian.total_harga }}</td>
                        <td>
                            <router-link :to="`/editPembelian/${pembelian.id}`">
                                <i class="fa fa-edit blue"></i>
                            </router-link>
                            /
                            <a href="#" @click="deletePembelian(pembelian.id)">
                                <i class="fa fa-trash red"></i>
                            </a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            pembelians: [],
        }
    },
    methods: {
        // editPembelian(id) {
        //     this.axios.get(`http://localhost:8000/api/pembelian/` + id).
        //         then(response => {
        //             console.log(response);
        //             this.editmode = true;
        //             this.errors = {};
        //             this.form = response.data.data;
        //             $('#addNew').modal('show');
        //         });
        // },
        updatePembelian() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/pembelian/` + this.form.id;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadPembelians();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        deletePembelian(id) {
            this.axios.delete(`http://localhost:8000/api/pembelian/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadPembelians();
                });
        },
        loadPembelians() {
            let uri = `http://localhost:8000/api/pembelian`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.pembelians = response.data;
                });
            this.form = {};
            this.errors = {};
            this.editmode = false;
        },
    },
    mounted() {
        console.log('User Component mounted.')

    },
    created() {
        this.loadPembelians();
    }
}
</script>