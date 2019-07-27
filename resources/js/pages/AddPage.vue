<template>
    <div>
        <menu-component></menu-component>
        <div class="app">
            <div class="container">
                <div v-if="this.error" class="alert alert-danger" role="alert">
                    {{this.message}}
                </div>
                <div v-if="this.success" class="alert alert-success" role="alert">
                    Success!
                </div>
                <form @submit.prevent="submit">
                    <div class="form-group">
                        <label for="inputGroupSelect01">Item Type</label>
                        <select class="custom-select" id="inputGroupSelect01" v-model="formData.type" required>
                            <option value="" selected>-</option>
                            <option value="cpf">CPF</option>
                            <option value="cnpj">CNPJ</option>
                        </select>
                    </div>
                    <div v-if="formData.type == 'cpf'" class="form-group">
                        <label for="cpf">CPF</label>
                        <the-mask type="text" class="form-control" id="cpf" v-model="formData.number" placeholder="CPF" :mask="['###.###.###-##']" required/>
                    </div>
                    <div v-if="formData.type == 'cnpj'" class="form-group">
                        <label for="cnpj">CNPJ</label>
                        <the-mask type="text" class="form-control" id="cnpj" v-model="formData.number" placeholder="CNPJ" :mask="['##.###.###/####-##']" required/>
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="blacklist" v-model="formData.blacklist">
                        <label class="form-check-label" for="blacklist">Blacklist</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Document</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    import MenuComponent from "../components/MenuComponent";
    import {get, post} from '../request';
    export default {
        name: "AddPage",
        components: {MenuComponent},
        data:function(){
            return{
                formData:{
                    blacklist:false
                },
                error: false,
                success: false,
                message:'',
                filters:{}
            }
        },
        methods:{
             async submit() {
                await post('api/v1/document', this.formData).then(resp => {
                    if(!resp.status){
                        this.error = true;
                        this.message = resp.message;
                    }else{
                        this.success = true;
                        this.formData = {};
                    }
                }).catch(resp => {
                    console.log(resp);
                });
            }
        }
    }
</script>

<style scoped>

</style>
