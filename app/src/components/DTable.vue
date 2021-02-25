<template>
  <v-container>
    <v-flex>
      <div class="tableBtn">
        <div>
          <input
            type="file"
            id="csv_file"
            name="csv_file"
            @change="loadCSV($event)"
          />
        </div>
        <div>
          <v-btn color="primary" @click="listLines">Listar</v-btn>
        </div>
        <div>
          <v-btn color="primary" @click="saveRegister">Salvar Registros</v-btn>
        </div>
      </div>
      <v-layout column>
        <v-flex md6 style="overflow: auto">
          <v-data-table
            :headers="headers"
            :items="lines"
            :footer-props="{
              'items-per-page-options': [10, 50, 100, 500, 1000, -1],
            }"
            :items-per-page="100"
            class="elevation-1"
          ></v-data-table>
        </v-flex>
      </v-layout>
    </v-flex>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  data() {
    return {
      file: null,
      hasRegister: false,
      parse_header: [],
      parse_csv: [],
      sortOrders: {},
      sortKey: "",
      result: [],
      lines: [],
      map: [],
      headers: [
        {
          text: "Registro",
          align: "start",
          value: "lead",
        },
        { text: "Nome", value: "nome" },
        { text: "E-mail", value: "email" },
        { text: "CPF/CNPJ", value: "cpf_cnpj" },
        { text: "Empresa", value: "empresa" },
        { text: "Profissão Cargo", value: "profissao_cargo" },
        { text: "Telefone", value: "telefone" },
        { text: "Cidade", value: "cidade" },
        { text: "Estado", value: "estado" },
        { text: "País", value: "pais" },
        { text: "Profissão Cargo", value: "status" },
        { text: "Estagio do Funil", value: "estagio_do_funil" },
        { text: "Titulo do Negócio", value: "titulo_do_negocio" },
        { text: "Valor do Negócio", value: "valor_do_negocio" },
        { text: "Conversões", value: "conversoes" },
        { text: "Última conversão", value: "ultima_conversao" },
        { text: "Domínio", value: "dominio" },
        { text: "Data de cadastro", value: "data_de_cadastro" },
        { text: "URL", value: "url" },
      ],
      fields: {
        lead: 0,
        nome: "",
        email: "",
        cpf_cnpj: "",
        empresa: "",
        profissao_cargo: "",
        telefone: "",
        cidade: "",
        estado: "",
        pais: "",
        status: "",
        estagio_do_funil: "",
        titulo_do_negocio: "",
        valor_do_negocio: "",
        conversoes: 0,
        ultima_conversao: "",
        dominio: "",
        data_de_cadastro: "",
        url: "",
      },
    };
  },
  methods: {
    sortBy: function(key) {
      let vm = this;
      vm.sortKey = key;
      vm.sortOrders[key] = vm.sortOrders[key] * -1;
    },
    csvJSON(csv) {
      let vm = this;
      let lines = csv.split("\n");
      let headers = lines[0].split(";");
      vm.parse_header = lines[0].split(";");
      lines[0].split(";").forEach(function(key) {
        vm.sortOrders[key] = 1;
      });
      lines.map(function(line, indexLine) {
        if (indexLine < 1) return; // Jump header line
        let obj = {};
        let currentline = line.split(";");
        headers.map(function(header, indexHeader) {
          obj[header] = currentline[indexHeader];
        });
        vm.result.push(obj);
      });
      vm.result.pop();
      return vm.result; // JavaScript object
    },
    loadCSV(e) {
      var vm = this;
      if (window.FileReader) {
        var reader = new FileReader();
        reader.readAsText(e.target.files[0]);
        // Handle errors load
        reader.onload = function(event) {
          var csv = event.target.result;
          vm.parse_csv = vm.csvJSON(csv);
        };
        reader.onerror = function(evt) {
          if (evt.target.error.name == "NotReadableError") {
            alert("Canno't read file !");
          }
        };
      } else {
        alert("FileReader are not supported in this browser.");
      }
    },
    listLines() {
      const value = /"/g;
      this.result.forEach((v) => {
        this.fields.lead = parseInt(v["#"]);
        this.fields.nome = v["Nome"].replace(value, "");
        this.fields.email = v["E-mail"];
        this.fields.cpf_cnpj = v['"CPF / CNPJ"'];
        this.fields.empresa = v["Empresa"].replace(value, "");
        this.fields.profissao_cargo = v['"Profissão / Cargo"'].replace(
          value,
          ""
        );
        this.fields.telefone = v["Telefone"].replace(value, "");
        this.fields.cidade = v["Cidade"];
        this.fields.estado = v["Estado"];
        this.fields.pais = v["País"].replace(value, "");
        this.fields.status = v["Status"];
        this.fields.estagio_do_funil = v['"Estágio do Funil"'];
        this.fields.titulo_do_negocio = v['"Título do Negócio"'];
        this.fields.valor_do_negocio = v['"Valor do Negócio"'];
        this.fields.conversoes = parseInt(v["Conversões"]);
        this.fields.ultima_conversao = v['"Última Conversão"'];
        this.fields.dominio = v["Domínio"];
        this.fields.data_de_cadastro = v['"Data de Cadastro"'].replace(
          value,
          ""
        );
        this.fields.url = v["URL\r"].replace("\r", "");
        this.map = new Map(Object.entries(this.fields));
        const obj = Object.fromEntries(this.map);
        this.lines.push(obj);
      });

      this.hasRegister = true;
    },
    saveRegister() {
      let dataRequest = null;
      for (let i = 0; i < 50; i++) {
        dataRequest = this.lines[i]
        axios
          .post("http://127.0.0.1:8000/api/lead", dataRequest)
          .then((response) => {
            console.log(response);
          })
          .catch((error) => {
            // Error
            if (error.response) {
              console.log(error.response.data);
              console.log(error.response.status);
              console.log(error.response.headers);
            } else if (error.request) {
              console.log(error.request);
            } else {
              console.log("Error", error.message);
            }
            console.log(error.config);
          });
      }
    },
  },
};
</script>

<style scoped>
.tableBtn {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 4rem;
}

</style>
