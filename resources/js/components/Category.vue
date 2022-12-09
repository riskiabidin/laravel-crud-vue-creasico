<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">Category List</h3>

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
                        <th scope="col">Nama Category</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="category in categories.data" :key="category.id">
                        <th scope="row">{{ category.id }}</th>
                        <td>{{ category.name_category }}</td>
                        <td>
                            <a href="#" @click="editCategory(category.id)">
                                <i class="fa fa-edit blue"></i>
                            </a>
                            /
                            <a href="#" @click="deleteCategory(category.id)">
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
                        <h1 class="modal-title fs-5" id="addNewLabel">Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form @submit.prevent="editmode ? updateCategory() : createCategory()">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Name:</label>
                                    <input v-model="form.name_category" type="text" class="form-control"
                                        placeholder="Input Name Category">
                                    <div class="text-danger" v-if="errors.name_category">{{ errors.name_category }}</div>
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
            categories: [],
            form: {
                id: '',
                name_category: '',
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
        createCategory() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/category`;
            this.axios.post(uri, this.form).
                then(response => {
                    console.log(response.data);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadCategories();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        editCategory(id) {
            this.axios.get(`http://localhost:8000/api/category/` + id).
                then(response => {
                    console.log(response);
                    this.editmode = true;
                    this.errors={};
                    this.form = response.data.data;
                    $('#addNew').modal('show');
                });
        },
        updateCategory() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/category/` + this.form.id;
            this.axios.put(uri, this.form).
                then(response => {
                    console.log(response);
                    $('#addNew').modal('hide');
                    this.$noty.success(response.data.message);
                    this.loadCategories();
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        deleteCategory(id) {
            this.axios.delete(`http://localhost:8000/api/category/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadCategories();
                });
        },
        loadCategories() {
            let uri = `http://localhost:8000/api/category`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.categories = response.data;
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
        this.loadCategories();
    }
}
</script>