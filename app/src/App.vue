<template>
  <v-app>
   <DTable />
  </v-app>
</template>

<script>
import DTable from './components/DTable';

export default {
  name: 'App',

  components: {
    DTable,
  },

  data: () => ({
    //
  }),
};
</script>
