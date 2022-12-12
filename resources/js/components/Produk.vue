<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">produk List</h3>

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
                        <th scope="col">Nama produk</th>
                        <th scope="col">category name</th>
                        <th scope="col">Harga Beli</th>
                        <th scope="col">Harga Jual</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="produk in produks.data" :key="produk.id">
                        <th scope="row">{{ produk.id }}</th>
                        <td>{{ produk.name_produk }}</td>
                        <td>{{ produk.category.name_category }}</td>
                        <td>{{ produk.harga_beli }}</td>
                        <td>{{ produk.harga_jual }}</td>
                        <td>{{ produk.stock }}</td>
                        <td>
                            <a href="#" @click="editProduk(produk.id)">
                                <i class="fa fa-edit blue"></i>
                            </a>
                            /
                            <a href="#" @click="deleteProduk(produk.id)">
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
                        <h1 class="modal-title fs-5" id="addNewLabel">produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateProduk() : createProduk()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>kode Produk:</label>
                                    <input v-model="form.kode_produk" type="number" class="form-control"
                                        placeholder="Input kode produk">
                                    <div class="text-danger" v-if="errors.kode_produk">{{ errors.kode_produk }}</div>
                                </div>
                                <div class="form-group">
                                    <label>category name:</label>
                                    <select v-model="form.id_category" class="form-control select2"
                                        style="width: 100%;">
                                        <option v-for="category in categories.data" :value="category.id">
                                            {{ category.name_category }}
                                        </option>
                                    </select>
                                    <div class="text-danger" v-if="errors.id_category">{{ errors.id_category }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Name Produk:</label>
                                    <input v-model="form.name_produk" type="text" class="form-control"
                                        placeholder="Input Name produk">
                                    <div class="text-danger" v-if="errors.name_produk">{{ errors.name_produk }}</div>
                                </div>
                                <div class="form-group">
                                    <label>merk</label>
                                    <input v-model="form.merk" type="text" class="form-control"
                                        placeholder="Input merk">
                                    <div class="text-danger" v-if="errors.merk">{{ errors.merk }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Beli:</label>
                                    <input v-model="form.harga_beli" type="number" class="form-control"
                                        placeholder="Input harga beli">
                                    <div class="text-danger" v-if="errors.harga_beli">{{ errors.harga_beli }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Harga Jual:</label>
                                    <input v-model="form.harga_jual" type="number" class="form-control"
                                        placeholder="Input harga jual">
                                    <div class="text-danger" v-if="errors.harga_jual">{{ errors.harga_jual }}</div>
                                </div>
                                <div class="form-group">
                                    <label>Stock:</label>
                                    <input v-model="form.stock" type="number" class="form-control"
                                        placeholder="Input stock">
                                    <div class="text-danger" v-if="errors.stock">{{ errors.stock }}</div>
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
            produks: [],
            categories: [],
            form: {},
            errors: {},
        }
    },
    methods: {
        newModal() {
            this.editmode = false;
            // this.form.reset();
            this.errors = {};
            $('#addNew').modal('show');
        },
        createProduk() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/produk`;
            this.axios.post(uri, this.form).
                then(response => {
                    console.log(response.data);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadProduk();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        editProduk(id) {
            this.axios.get(`http://localhost:8000/api/produk/` + id).
                then(response => {
                    console.log(response);
                    this.editmode = true;
                    this.errors = {};
                    this.form = response.data.data;
                    $('#addNew').modal('show');
                });
        },
        updateProduk() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/produk/` + this.form.id;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadProduk();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        deleteProduk(id) {
            this.axios.delete(`http://localhost:8000/api/produk/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadProduk();
                });
        },
        loadProduk() {
            let uri = `http://localhost:8000/api/produk`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.produks = response.data;
                });
            this.form = {};
            this.errors = {};
            this.editmode = false;
        },
        loadCategories() {
            let uri = `http://localhost:8000/api/category`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.categories = response.data;
                });

        },
    },
    mounted() {
        console.log('User Component mounted.')

    },
    created() {
        this.loadProduk();
        this.loadCategories();
    }
}
</script>