<template>
    <div>
        <menu-component></menu-component>
        <div class="app">
            <div class="container">
                <div class="filter">
                    <form id="filter" @submit.prevent="filter">
                        <h3>Filter</h3>
                        <div class="form-group">
                            <label for="inputGroupSelect01">Item Type</label>
                            <select class="custom-select" id="inputGroupSelect01" v-model="filters.type">
                                <option value="" selected>-</option>
                                <option value="cpf">CPF</option>
                                <option value="cnpj">CNPJ</option>
                            </select>
                        </div>
                        <div v-if="filters.type == 'cpf'" class="form-group">
                            <label for="cpf">CPF</label>
                            <the-mask type="text" class="form-control" id="cpf" v-model="filters.number" placeholder="CPF" :mask="['###.###.###-##']"/>
                        </div>
                        <div v-if="filters.type == 'cnpj'" class="form-group">
                            <label for="cnpj">CNPJ</label>
                            <the-mask type="text" class="form-control" id="cnpj" v-model="filters.number" placeholder="CNPJ" :mask="['##.###.###/####-##']"/>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="blacklist" v-model="filters.blacklist">
                            <label class="form-check-label" for="blacklist">Blacklist</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                </div>
                <div class="table-component">
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Number</th>
                                <th>Blacklist</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="item in gridItens">
                                <td>{{item.type}}</td>
                                <td>{{item.number}}</td>
                                <td>{{item.blacklist}}</td>
                                <td>
                                    <router-link :to="{name: 'edit', params: {id: item._id}}">Edit</router-link>
                                    <a href="#" @click="removeDoc(item._id)">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <pagination-component :pagination="pagination"
                                      @paginate="getDocs()">
                </pagination-component>
                <router-link to="/add"><button type="button" class="btn btn-primary">Add Document</button></router-link>
            </div>
        </div>
    </div>
</template>

<script>
    import MenuComponent from "../components/MenuComponent";
    import TableComponent from "../components/TableComponent";
    import PaginationComponent from "../components/PaginationComponent";
    import {get,remove} from "../request"

    export default {
        name: "HomePage",
        components: {PaginationComponent, TableComponent, MenuComponent},
        data:function () {
            return {
                gridItens:[],
                pagination:{current_page:1},
                gridColumn:['type', 'number','actions'],
                filters:{}
            }
        },
        methods:{
            async getDocs(){
                await get('api/v1/document?page='+this.pagination.current_page).then(resp => {
                    this.gridItens = resp.data.data;
                    this.pagination = resp.data;
                });
            },
            async filter(){
                let str = "";
                for (var key in this.filters) {
                    if (str != "") {
                        str += "&";
                    }
                    str += key + "=" + encodeURIComponent(this.filters[key]);
                }
                await get('api/v1/document?'+str).then(resp => {
                    this.gridItens = resp.data.data;
                    this.pagination = resp.data;
                });
            },
            removeDoc: function (id) {
                remove('api/v1/document', id).then(resp => {
                     this.getDocs();
                });
            }
        },
        mounted() {
            this.getDocs();
        }
    }
</script>

<style scoped>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .table-component{
        width: 100%;
        margin-bottom: 20px;
        margin-top: 20px;
    }
</style>