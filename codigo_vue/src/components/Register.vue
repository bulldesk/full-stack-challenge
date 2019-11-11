<template>
  <div class="login">
    <h2>Cadastrar</h2>
    <form v-on:submit="handleSubmit($event)">
      <md-field>
        <label>Nome</label>
        <md-input v-model="user.name"></md-input>
      </md-field>
      <br />
      <md-field>
        <label>E-mail</label>
        <md-input v-model="user.email"></md-input>
      </md-field>
      <br />
      <md-field>
        <label>Senha</label>
        <md-input v-model="user.password" type="password"></md-input>
      </md-field>
      <br />
      <div class="btn-login">
        <md-button type="submit" class="md-raised md-primary"><md-icon>send</md-icon> Cadastrar</md-button>
        <p>
          <span>
            <router-link to="/login"><md-icon>arrow_back</md-icon>Voltar para tela de login</router-link>
          </span>
        </p>
      </div>
    </form>
  </div>
</template>
<script>
export default {
  name: 'register',
  data () {
    return {
      user: {
        name: null,
        email: null,
        password: null
      }
    }
  },
  methods: {

    handleSubmit: function (e) {
      this.$http.post(process.env.API + 'user', this.user).then(function (response) {
      // Success
        this.$toast.success({
          title: 'Usuario cadastrado com sucesso',
          message: response.data.mensagem
        })
        console.log(response.data)
        this.$router.push('/login')
      }, function (response) {
        // Error
        var msg = ''
        for (var key in response.data) {
          msg = msg + ' \n ' + response.data[key]
        }
        this.$toast.error({
          title: 'Erro ao cadastrar usuario',
          message: msg
        })
        console.log(response.data)
      })
    }
  }
}
</script>
