<template>
    <div class="container">
        <form @submit.prevent="importLeads">
            <div class="row">
                <div class="col-md-6">
                    <label>Leads</label>

                    <vue-csv-import
                        :url="importLeadsRoute"
                        :map-fields="fieldList"
                        headers="true"
                        loadBtnText="Mapear!"
                        submitBtnText="Enviar!"
                        v-model="file">

                        <template slot="error">
                            Arquivo Inválido
                        </template>

                        <template slot="thead">
                            <tr>
                                <th>Colunas do Banco</th>
                                <th>Colunas do CSV</th>
                            </tr>
                        </template>
                    </vue-csv-import>

                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import { VueCsvImport } from 'vue-csv-import';
    export default {
        props: [
            'importLeadsRoute'
        ],
        components: {
            VueCsvImport
        },
        name: "LeadComponent",
        mounted() {
            console.log('LeadComponent pronto.');
        },
        data(){
            return {
                file: [],
                fieldList: [
                    'codigo',
                    'nome',
                    'email',
                    'cpf_cnpj',
                    'empresa',
                    'profissao_cargo',
                    'telefone',
                    'cidade',
                    'estado',
                    'pais',
                    'status',
                    'estagio_funil',
                    'titulo_negocio',
                    'valor_negocio',
                    'conversoes',
                    'ultima_conversao',
                    'dominio',
                    'data_cadastro',
                    'url'
                ]
            }
        },
        methods: {
        }
    }
</script>

<style scoped>

</style>
