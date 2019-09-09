<template>
    <div class="row">
        <div id="table" class="col-xs-12 table-responsive">
            <datatable :columns="columns" :data="rows">
                <template scope="{ row }">
                    <tr>
                        <td>
                            <button
                                v-if="row.role !== 'superadmin'"
                                class="btn btn-xs btn-primary"
                                @click="expand(row.id)"
                            >
                                <span>Edit Access</span>
                            </button>
                        </td>
                        <td>{{ row.id }}</td>
                        <td>{{ row.role }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.email }}</td>
                    </tr>
                    <template v-if="expanded === row.id">
                        <tr >
                            <td><b>Name Controller</b></td>
                            <td><b>Access Status</b></td>
                        </tr>
                        <tr v-if="expanded === row.id">
                            <td>
                                {{ controllers.name }}
                            </td>
                            <td>
                                <input type="checkbox">
                            </td>
                        </tr>
                    </template>
                </template>
            </datatable>
        </div>
    </div>
</template>

<script>
import Vue from 'vue';
import DatatableFactory from 'vuejs-datatable';
Vue.use(DatatableFactory);
import getAllowedControllers from '../api/getAllowedControllers';

export default {
    mounted () {
        // TODO overlay
        axios.post('/users')
            .then((response) => {
                _.each(response.data, (value) => {
                    value.actions = '<a class="btn btn-primary" href="11" role="button">2222</a>';
                });

                this.rows = response.data;
            });
    },
    data () {
        return {
            columns: [
                {
                    label: '',
                    field: '',
                    sortable: false
                },
                {
                    label: 'id',
                    field: 'id'
                },
                {
                    label: 'Role',
                    field: 'role',
                    headerClass: 'class-in-header second-class'
                },
                {
                    label: 'First Name',
                    field: 'name'
                },
                {
                    label: 'Email',
                    field: 'email'
                },
            ],
            rows: [],
            expanded: null,
            controllers: [],
        };
    },
    methods: {
        expand (id) {
            if (this.expanded === id) {
                this.expanded = null;

                return;
            }

            this.expanded = id;

            getAllowedControllers()
                .then((response) => {
                    this.controllers = response.data;
                });
        }
    }
};
</script>
