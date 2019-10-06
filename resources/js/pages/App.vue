<template>
  <div>
    <Navbar />
    
    <router-view />
  </div>
</template>

<script>
import Navbar from '../components/Navbar';

export default {
  name: 'App',

  components: {
    Navbar,
  },

  mounted() {
    window.Echo.channel('leads-notification').listen('.leadsImported', () => {
      this.$store.commit('SET_FINISHED', true);
    });
  },
};
</script>