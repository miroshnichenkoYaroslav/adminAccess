<template>
    <div class="row">
        <div id="table" class="col-xs-12 table-responsive">
            <datatable :columns="columns" :data="rows">
                <template scope="{ row }">
                    <tr>
                        <td>
                            <button
                                v-if="row.name !== 'superadmin'"
                                class="btn btn-xs btn-primary"
                                @click="expand(row.id)"
                                :disabled="meId === row.id"
                            >
                                <span>Edit Access</span>
                            </button>
                        </td>
                        <td>{{ row.id }}</td>
                        <td>{{ row.role.name }}</td>
                        <td>{{ row.name }}</td>
                        <td>{{ row.email }}</td>
                    </tr>
                    <template v-if="expanded === row.id">
                        <tr>
                            <td><b>Name Controller</b></td>
                            <td><b>Access Status</b></td>
                        </tr>
                        <tr v-for="(value, name) in controllers">
                            <td>
                                {{ name }}
                            </td>
                            <td>
                                <label>
                                    <input
                                        :ref="name"
                                        type="checkbox"
                                        :checked="value === true"
                                        @change="changeAccessStatus(name, expanded)"
                                    >
                                </label>
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

import getAllControllersAndPermissions from '../api/getAllControllersAndPermissions';
import getUsers from '../api/getUsers';
import changeAccessStatusForController from '../api/changeAccessStatusForController';
import loadMeID from '../api/loadMeID';

export default {
    mounted () {
        loadMeID()
            .then((response) => {
                this.meId = response.data;
            });
        getUsers()
            .then((response) => {
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
            permissions: [],
            meId: null,
        };
    },
    methods: {
        expand (id) {
            if (this.expanded === id) {
                this.expanded = null;

                return;
            }

            this.expanded = id;

            getAllControllersAndPermissions (id)
                .then((response) => {
                    this.controllers = response.data;
                });
        },
        changeAccessStatus (name, id) {
            const data = {
                accessStatus: this.$refs[name][0].checked,
                controller: name,
                id,
            };

            changeAccessStatusForController(data)
                .then((response) => {
                    console.log(response);
                });

        }
    }
};
</script>
