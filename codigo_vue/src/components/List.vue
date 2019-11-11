<template>
  <div>
    <span>
      <router-link to="/import"><md-icon>cloud_upload</md-icon> Importar leeds por csv</router-link>
    </span>
    <md-table v-model="leeds" md-sort="name" md-sort-order="asc" md-card>
      <md-table-toolbar>
        <h1 class="md-title">Leeds</h1>
      </md-table-toolbar>

      <md-table-row slot="md-table-row" slot-scope="{ item }">
        <md-table-cell md-label="#"        md-numeric md-sort-by="code">{{ item.code }}</md-table-cell>
        <md-table-cell md-label="Nome"                md-sort-by="name">{{ item.name }}</md-table-cell>
        <md-table-cell md-label="E-mail"              md-sort-by="email">{{ item.email }}</md-table-cell>
        <md-table-cell md-label="CPF / CNPJ"          md-sort-by="cpf">{{ item.cpf }}</md-table-cell>
        <md-table-cell md-label="Título do Negócio"   md-sort-by="title">{{ item.title }}</md-table-cell>
      </md-table-row>
    </md-table>
  </div>
</template>
<script>
export default {
  name: 'List',
  data () {
    return {
      resource: this.$resource(process.env.API + 'leed'),
      leeds: []
    }
  },
  methods: {
    initialize () {
      this.resource.get({}).then(response => {
        this.leeds = response.data
      })
    }
  },
  created () {
    this.initialize()
  }
}
</script>
