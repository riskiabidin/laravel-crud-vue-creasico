<template>
    <section class="content">

        <div class="card-header">
            <h3 class="card-title">penjualan List</h3>

            <div class="card-tools">

                <router-link to="/insert_penjualan" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-square"></i>Create penjualan
                </router-link>
            </div>

        </div>
        <div class="card-body ">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama member</th>
                        <th scope="col">Total penjualan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="penjualan in penjualans.data" :key="penjualan.id">
                        <th scope="row">{{ penjualan.id }}</th>
                        <td>{{ penjualan.member.nama }}</td>
                        <td>{{ penjualan.total_harga }}</td>
                        <td>
                            <router-link :to="`/editPenjualan/${penjualan.id}`">
                                <i class="fa fa-edit blue"></i>
                            </router-link>
                            /
                            <a href="#" @click="deletePenjualan(penjualan.id)">
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
            penjualans: [],
        }
    },
    methods: {
        
        deletePenjualan(id) {
            this.axios.delete(`http://localhost:8000/api/penjualan/` + id).
                then(response => {
                    console.log(response);
                    this.$noty.success(response.data.message);
                    this.loadpenjualans();
                });
        },
        loadpenjualans() {
            let uri = `http://localhost:8000/api/penjualan`;
            this.axios.get(uri).
                then(response => {
                    console.log(response.data);
                    this.penjualans = response.data;
                });
        },
    },
    mounted() {
        console.log('User Component mounted.')

    },
    created() {
        this.loadpenjualans();
    }
}
</script>