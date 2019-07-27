<template>
    <div>
        <menu-component></menu-component>
        <div class="app">
            <div class="container">
                <table class="table-component">
                    <thead>
                        <tr>
                            <th>Posts</th>
                            <th>Gets</th>
                            <th>Puts</th>
                            <th>Deletes</th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{item.qt_post}}</td>
                        <td>{{item.qt_get}}</td>
                        <td>{{item.qt_put}}</td>
                        <td>{{item.qt_delete}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import MenuComponent from "../components/MenuComponent";
    import {get} from "../request";
    export default {
        name: "StatusPage",
        components: {MenuComponent},
        data:function () {
            return {
                item:{},
            }
        },
        methods:{
            async getStatus(id){
                await get('api/v1/status').then(resp => {
                    this.item = resp.data;
                });
            },
        },
        mounted() {
            this.getStatus(this.$route.params.id);
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