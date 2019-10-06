<template>
  <div class="container mt-5">
    
    <div class="row">
      <div class="col">

        <input
          class="form-control mb-2"
          type="text"
          placeholder="Nome"
          v-model="name"
        />

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
          class="btn btn-primary"
          @click="register"
        >
          Enviar
        </button>
      
      </div>
    </div>

  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Registration',

  data() {
    return {
      name: '',
      email: '',
      password: '',
    };
  },

  methods: {
    register() {
      axios.post('/api/register', {
        name: this.name,
        email: this.email,
        password: this.password,
      })
        .then(() => {
          this.$router.push('/');
        })
        .catch(() => {
          this.$router.push('/');
        });
    },
  },
};
</script>