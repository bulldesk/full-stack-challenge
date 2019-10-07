<template>
  <nav class="navbar navbar-dark bg-light">
    <a class="navbar-brand">
      Full Stack Challenge
    </a>
    <form class="form-inline" v-if="logged">
      <button class="btn btn-light" @click="logout">
        Logout
      </button>
    </form>
  </nav>
</template>

<script>
export default {
  name: 'Navbar',

  computed: {
    logged() {
      return this.$store.state.isLogged;
    },
  },

  methods: {
    logout() {
      this.$store.commit('RESET_TOKEN');
      this.$router.push('/');
    },
  },
};
</script>