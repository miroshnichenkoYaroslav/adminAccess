<template>
    <datatable :columns="columns" :data="rows"></datatable>
</template>

<script>
import Vue from 'vue';
import DatatableFactory from 'vuejs-datatable';

Vue.use(DatatableFactory);
    export default {
        mounted() {
            // TODO overlay
            axios.post('/users')
                .then((response) => {
                    this.rows = response.data;
                })
        },
        data() {
            return {
                columns: [
                    { label: 'id', field: 'id' },
                    { label: 'Role', field: 'role', headerClass: 'class-in-header second-class' },
                    { label: 'First Name', field: 'name' },
                    { label: 'Email', field: 'email' },
                    { label: 'Actions', field: 'email' },
                ],
                rows: [],
            };
        },
    }
</script>
