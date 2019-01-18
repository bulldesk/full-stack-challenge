<template>
    <div>
      <nav-bar title=""></nav-bar>
          <div v-if="this.mensagem" class="alert alert-success" role="alert">
            Importação realizada com sucesso!
            Você será notificado quando ela for concluída.
          </div>  
          <h2>Importar leads</h2>
          <div v-if="this.etapa === 1" class="form-group">
              <input type="file" class="form-control-file" id="file" ref="file" v-on:change="handleFileUpload()">
          </div>
            <p v-if="this.etapa === 2"> Selecione os campos do arquivo para a respectiva coluna do BD </p>
          <table v-if="this.etapa === 2" class="table table-striped importacao-table">
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
          <button v-if="etapa == 1" v-on:click="submitFile(1)" type="submit" class="btn btn-primary">Importar</button>
          <button v-if="etapa == 2" v-on:click="submitFile(2)" type="submit" class="btn btn-primary">Importar</button>
      </div>
</template>

<script>
    import NavBar from '../components/NavBarComponent'
    import * as s from '../servicos'

    export default {
      name:'AdminPage',
      data () {        
        return {
          leadFields:{
              id: "ID",
              nome: "Nome",
              email: 'Email',
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
          associations:{},
          items:[],
          file: '',
          etapa: 1,
          mensagem: false
        }
      },
      methods:{
        created(){ 
          this.listen();
        }, 
        submitFile(etapa){
            if(etapa == 1){
              let formData = new FormData();
              formData.append('file', this.file);
              axios.post( '/api/importacao/headers',formData,{
                  headers: {
                      'Content-Type': 'multipart/form-data',
                      'Authorization': 'Basic ' + JSON.parse(localStorage.getItem('credenciais')).credenciais
                  }
                }
              ).then((res) => {
                  this.items = res.data.data.headers;
                  this.file = res.data.data.url;
                  this.etapa++;
              })
              .catch((err) => console.error(err));
            }
            if(etapa == 2){
              this.etapa = 2;
              let data = {
                'associations': this.associations,
                'url': this.file
              }
              s.fazImportacao(data).then(resp => {
                  this.etapa = 1;
                  this.mensagem = true;
              });
            }
        },
        handleFileUpload(){
            this.file = this.$refs.file.files[0];
        },
        listen(){
            Echo.channel('importacao')
                .listen('.importacaoLeadsFinalizada', (e) => {
                    console.log(e.update);
            });
        }
      },
      components:{
         NavBar
      },
      mounted(){
          console.log('Component mounted.')
      }
    }
</script>
