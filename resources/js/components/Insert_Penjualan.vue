<template>
    <section class="content">

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">penjualan</h3>
            </div>

            <form @submit.prevent="createPenjualan">
                <div class="card-body">
                    <div class="form-group">
                        <label>member name:</label>
                        <select v-model="form.id_member" class="form-control select2" style="width: 100%;">
                            <option v-for="member in members.data" :value="member.id">
                                {{ member.nama }}
                            </option>
                        </select>
                        <div class="text-danger" v-if="errors.id_member">{{ errors.id_member }}</div>
                    </div>
                    <div class="form-group">
                        <label>Total Harga</label>
                        <input disabled type="number" v-model="form.total_harga" class="form-control"
                            placeholder="Input total harga">
                        <div class="text-danger" v-if="errors.total_harga">{{ errors.total_harga }}</div>

                    </div>
                    <div class="card-tools">
                        <a href="#" class="btn btn-sm btn-primary" @click="newModal">
                            <i class="fa fa-plus-square"></i>
                        </a>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <!-- <th scope="col">ID produk</th> -->
                                <th scope="col">Name Produk</th>
                                <th scope="col">Harga beli</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">sub Total</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(detail, index) in form.detail">
                                <th scope="row"></th>
                                <!-- <td>{{ detail.id_produk }}</td> -->
                                <td>{{ detail.name_produk }}</td>
                                <td>{{ detail.harga_jual }}</td>
                                <td>{{ detail.jumlah }}</td>
                                <td>{{ detail.sub_total }}</td>
                                <td>
                                    <a href="#" @click="editDetail(index)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    /
                                    <a href="#" @click="deleteDetail(index)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>


                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
            </form>
            <!-- Modal -->
            <div class="modal fade" id="addNew" tabindex="-1" aria-labelledby="addNew" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="addNewLabel">produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form @submit.prevent="editmode ? updateDetail() : createDetail()">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Produk name:</label>
                                        <select required @change="detail()" v-model="form2.id_produk"
                                            class="form-control select2" style="width: 100%;">
                                            <option v-for="produk in produks.data" :value="produk.id">
                                                {{ produk.name_produk }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Harga Beli:</label>
                                        <input disabled v-model="form2.harga_jual" type="number" class="form-control"
                                            placeholder="Input harga beli">
                                    </div>
                                    <div class="form-group">
                                        <label>Jumlah:</label>
                                        <input @click="hitungSubTotal()" @keyup="hitungSubTotal()"
                                            v-model="form2.jumlah" type="number" class="form-control"
                                            placeholder="Input Jumlah">
                                    </div>
                                    <div class="form-group">
                                        <label>sub_total:</label>
                                        <input disabled v-model="form2.sub_total" type="number" class="form-control"
                                            placeholder="Input sub Total">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>

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
            indexDetail: null,
            form: {
                detail: []
            },
            form2: {
                id_produk: '',
                name_produk: '',
                harga_jual: 0,
                jumlah: 1,
                sub_total: 0,

            },
            members: [],
            produks: [],
            errors: {}

        }
    },
    methods: {
        detail() {
            for (let i = 0; i < this.produks.data.length; i++) {
                if (this.produks.data[i].id == this.form2.id_produk) {
                    this.form2.name_produk = this.produks.data[i].name_produk;
                    this.form2.harga_jual = this.produks.data[i].harga_jual;
                    this.hitungSubTotal();
                }
                console.log(this.form2.harga_jual);
            }
        },
        hitungSubTotal() {
            this.form2.sub_total = this.form2.harga_jual * this.form2.jumlah;
        },
        hitungTotalHarga() {
            this.form.total_harga = 0;
            for (let i = 0; i < this.form.detail.length; i++) {
                this.form.total_harga += this.form.detail[i].sub_total;
                console.log(this.form.total_harga);
            }
        },
        newModal() {
            this.editmode = false;
            // this.form.reset();
            this.errors = {};
            $('#addNew').modal('show');
        },
        bersih(){
            this.editmode = false;
            this.indexDetail=null;
            this.form2 = {
                id_produk: '',
                name_produk: '',
                harga_jual: 0,
                jumlah: 1,
                sub_total: 0,
            };
        },
        createDetail() {
            // console.log(this.produks.data);
            this.form.detail.push(this.form2);
            this.hitungTotalHarga();
            this.bersih();
            // console.log(this.form);

        },
        deleteDetail(index) {
            this.form.detail.splice(index, 1);
            this.hitungTotalHarga();

        },
        editDetail(index) {
            this.indexDetail = index;
            this.editmode = true;
            this.form2.id_produk = this.form.detail[index].id_produk;
            this.form2.harga_jual = this.form.detail[index].harga_jual;
            this.form2.jumlah = this.form.detail[index].jumlah;
            this.form2.sub_total = this.form.detail[index].sub_total;
            $('#addNew').modal('show');
        },
        updateDetail() {
            this.hitungTotalHarga();
            this.form.detail[this.indexDetail].id_produk = this.form2.id_produk;
            this.form.detail[this.indexDetail].name_produk = this.form2.name_produk;
            this.form.detail[this.indexDetail].harga_jual = this.form2.harga_jual;
            this.form.detail[this.indexDetail].jumlah = this.form2.jumlah;
            this.form.detail[this.indexDetail].sub_total = this.form2.sub_total;
            $('#addNew').modal('hide');
            this.bersih();

        },
        createPenjualan() {
            console.log(this.form)
            let uri = `http://localhost:8000/api/penjualan`;
            this.axios.post(uri, this.form).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.$router.push({ name: 'penjualan' });
                }).
                catch((error) => {
                    console.log(error.response);
                    this.errors = error.response.data.errors;
                });
        },
        loadMembers() {
            let uri = `http://localhost:8000/api/member`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.members = response.data;
                });

        },
        loadProduks() {
            let uri = `http://localhost:8000/api/produk`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.produks = response.data;
                });

        },
    },
    mounted() {

        console.log('Component mounted.')
    },
    created() {
        this.loadMembers();
        this.loadProduks();
    }
}
</script>