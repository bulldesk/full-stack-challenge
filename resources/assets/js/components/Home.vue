<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="panel-body">
            </div>
                <div class="col-md-8">

                    <div class="card card-default">
                        <div class="card-body" style="padding: 36px">
                            <div class="col-md-12 card-headr">
                                Importar arquivo de Leads
                            </div>
                            <div class="b-b-1">
                                <div class="col-lg-4 pl-0 fileUpload btn btn-outline-primary">
                                    <label>Selecione o arquivo
                                        <input class="upload" type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                                    </label>
                                </div>
                            </div>
                            <div class="m-20-10">
                                <button class="btn btn-primary" v-on:click="submitFile()">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</template>

<script>
    import {importLeads} from '../helpers/auth';

    export default {
        name: 'home',

        computed: {
            currentUser() {
                return this.$store.getters.currentUser;
            },
            welcome() {
                return this.$store.getters.welcome
            },
        },
        data() {
            return {
                file: '',
            };
        },
        methods: {
            submitFile(){
                let vm        = this
                let formData  = new FormData()
                var objectFie = ''

                for(var pair of formData.entries()) {
                    objectFie = pair[1]
                }

                formData.append('file', vm.file)
                formData.append('file', objectFie)

                axios.post( '/api/importLeads',
                    formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data',
                            "Authorization": `Bearer ${this.currentUser.token}`
                        }
                    }
                )
            },
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            }
        }
    }
</script>

<style>
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
    .b-b-1{
        border-bottom: solid 1px #EEE;
    }
    .m-20-10 {
        margin: 20px 10px 0px;
    }
    label{
        margin-bottom: 0px !important;
    }
</style>