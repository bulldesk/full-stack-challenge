<template>
  <div class="login">
    <h2>Login</h2>
    <form v-on:submit="handleSubmit($event)">
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
        <md-button type="submit" class="md-raised md-primary"><md-icon>send</md-icon> Login</md-button>
      </div>
      <p>
        Você não tem conta?
        <span>
          <router-link to="/register">crie uma conta</router-link>
        </span>
      </p>
    </form>
  </div>
</template>
<script>
export default {
  name: 'login',
  data () {
    return {
      user: {
        email: null,
        password: null
      }
    }
  },
  methods: {
    handleSubmit: function (e) {
      e.preventDefault()
      // Auth
      this.$auth.login({
        params: this.user,
        success: function () {
          this.$toast.success({
            title: 'Usuário logado com sucesso',
            message: ''
          })
          console.log('Usuário logado com sucesso.')
        },
        error: function () {
          this.$toast.error({
            title: 'Usuário e/ou senha inválidos',
            message: ''
          })
          console.log('Usuário e/ou senha inválidos.')
        },
        rememberMe: true,
        redirect: '/list'
      })
    }
  }
}
</script>
