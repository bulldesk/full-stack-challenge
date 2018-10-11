<template>
<div>
    <nav-bar title="Bulldesk"></nav-bar>
        <h2>Importar leads</h2>
           <div class="form-group">
              <input type="file" class="form-control-file" id="file" ref="file" v-on:change="handleFileUpload()">
          </div>
          <table class="table table-striped">
            <thead> 
              <tr>
                <th scope="col">Campos do arquivo</th>
                <th scope="col">Campos disponíveis do sistema</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(item, index) of items">
                <th scope="row">{{item}}</th>
                <td>
                  <select v-bind:id="index" v-model="associations[item]">
                    <option v-for="(option, index) in leadFields" v-bind:value="index">
                      {{ option }}
                    </option>
                  </select>
                </td>
              </tr>
            </tbody>
          </table>
              <button v-if="items.length == 0" v-on:click="submitFile(1)" type="submit" class="btn btn-primary">Importar</button>
    <button v-if="items.length > 0" v-on:click="submitFile(2)" type="submit" class="btn btn-primary">Importar</button>
</div>
</template>


<script>
import NavBar from '../components/NavBarComponent'
import Modal from '../components/ModalComponent'

 export default {
        name:'AdminPage',
        data () {        
          return {
            leadFields:{
              id: "ID",
              nome: "Nome",
              cpf_cnpj: "CPF / CNPJ", 
              profissao: "Profissão", 
              empresa: "Empresa" ,
              telefone: "Telefone", 
              cidade: "Cidade", 
              estado: "Estado", 
              pais: "País", 
              status: "Status", 
              estagio_funil: "Estágio do Funil",
              titulo_negocio: "Título do Negócio", 
              valor_negocio: "Valor do Negócio",
              conversoes: "Conversões", 
              ultima_conversao: "Última conversão", 
              dominio: "Domínio",
              data_cadastro: "Data de Cadastro",
              url: "Url"
            },
            associations:{
            },
            items:[],
            file: ''
          }
        },
        methods:{
          submitFile(etapa){
            if(etapa == 1){
              let formData = new FormData();
              formData.append('file', this.file);
              console.log(this.file);
              axios.post( '/api/import/headers',formData,{
                  headers: {
                      'Content-Type': 'multipart/form-data'
                  }
                }
              )
              .then((res) => {
                  this.items = res.data.data.headers;
                  this.file = res.data.data.url;
              })
              .catch((err) => console.error(err));
            }
            if(etapa == 2){
               let data = {
                 'associations': this.associations,
                 'url': this.file
               }
               axios.post('/api/import', data,{
                    headers: {
                        'Content-Type': 'application/json'
                    }
                  }
                )
              .then((res) => {
                    this.items = res.data.data.headers;
              })
              .catch((err) => console.error(err));
            }
          },
          handleFileUpload(){
            this.file = this.$refs.file.files[0];
          }
        },
        components:{
          NavBar,
          Modal
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
