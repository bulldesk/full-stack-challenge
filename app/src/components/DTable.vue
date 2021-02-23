<template>
    <div>
        <h4>CSV Import</h4>
        <label for="csv_file">CSV file to import</label>
        <input
            type="file"
            id="csv_file"
            name="csv_file"
            @change="loadCSV($event)"
        />
        <label for="header_rows"
            ><input type="checkbox" id="header_rows" /> File contains header
            row?</label
        >
        <div>
            <button @click="saveRegister">Salvar</button>
        </div>

        <!-- <table v-if="parse_csv">
            <thead>
                <tr>
                    <th
                        v-for="(parse, key) in parse_header"
                        :key="key"
                        @click="sortBy(parse)"
                    >
                        {{ parse }}
                    </th>
                </tr>
            </thead>
            <tr v-for="(csv, key) in parse_csv" :key="key">
                <td v-for="(parse, key) in parse_header" :key="key">
                    {{ csv[parse] }}
                </td>
            </tr>
        </table> -->
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            channel_name: "",
            channel_fields: [],
            channel_entries: [],
            parse_header: [],
            parse_csv: [],
            sortOrders: {},
            sortKey: "",
            result: [],
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
                valor_do_negocio: 0.0,
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
            this.fields.lead = parseInt(vm.result[1]["#"]);
            this.fields.nome = vm.result[1]["Nome"];
            this.fields.email = vm.result[1]["E-mail"];
            this.fields.cpf_cnpj = vm.result[1]["CPF / CNPJ"];
            this.fields.empresa = vm.result[1]["Empresa"];
            this.fields.profissao_cargo = vm.result[1]["Profissão / Cargo"];
            this.fields.telefone = vm.result[1]["Telefone"];
            this.fields.cidade = vm.result[1]["Cidade"];
            this.fields.estado = vm.result[1]["Estado"];
            this.fields.pais = vm.result[1]["País"];
            this.fields.status = vm.result[1]["Status"];
            this.fields.estagio_do_funil = vm.result[1]["Estágio do Funil"];
            this.fields.titulo_do_negocio = vm.result[1]["Título do Negócio"];
            this.fields.valor_do_negocio = null;
            this.fields.conversoes = parseInt(vm.result[1]["Conversões"]);
            this.fields.ultima_conversao = vm.result[1]["Última Conversão"];
            this.fields.dominio = vm.result[1]["Domínio"];
            this.fields.data_de_cadastro = vm.result[1]["Data de Cadastro"];
            this.fields.url = vm.result[1]["URL\r"].replace("\r", "");
            // }
            console.log(this.fields);
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
        saveRegister() {
            const dataRequest = JSON.stringify(this.fields);
            console.log(dataRequest);
            axios
                .post("http://127.0.0.1:8000/api/lead", dataRequest)
                .then((response) => {
                    console.log(response);
                })
                .catch((error) => {
                    // Error 😨
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
        },
    },
};
</script>

<style scoped></style>
