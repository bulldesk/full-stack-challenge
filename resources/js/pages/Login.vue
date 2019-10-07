<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col justify-content-center">

        <Card title="Acesse sua conta">
          <input
            class="form-control mb-2"
            type="text"
            placeholder="E-mail"
            v-model="email"
          />

          <input
            class="form-control mb-2"
            type="password"
            placeholder="Senha"
            v-model="password"
          />

          <button
            class="btn btn-primary mb-2"
            @click="login"
          >
            Entrar
          </button>

          <button
            class="btn btn-link"
            @click="register"
          >
            Registrar-se
          </button>
        </Card>
      
      </div>
    </div>
  </div>
</template>

<script>
import Card from '../components/auth/Card';
import axios from 'axios';

export default {
  name: 'Login',

  data() {
    return {
      email: '',
      password: '',
    };
  },

  methods: {
    login() {
      axios.post('/api/login', {
        email: this.email,
        password: this.password,
      })
        .then(async (res) => {

          const { token } = res.data;
          await this.$store.commit('SET_TOKEN', token);

          this.$router.push('/upload');
        })
        .catch((err) => {
          console.log(err);
        })
    },
    register() {
      this.$router.push('/registration');
    },
  },

  components: {
    Card,
  },
};
</script>