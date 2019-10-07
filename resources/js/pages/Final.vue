<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        
        <p v-if="!finished">
          A importação dos dados foi <span class="text-primary">iniciada</span>.
        </p>

        <p v-else>
          A importação dos dados foi <span class="text-success">finalizada</span>.
        </p>

      </div>
      <div class="col">
        <Alert title="Atenção" ref="alert">
          Importação de dados finalizada!
        </Alert>
      </div>
    </div>
  </div>
</template>

<script>
import Alert from '../components/Alert';
import { mapState } from 'vuex';

export default {
  name: 'Final',

  computed: {
    ...mapState([
      'finished',
    ]),
  },

  watch: {
    finished: {
      handler(value) {
        if (value) {
          this.$refs.alert.show();
        }
      },
    },
  },

  components: {
    Alert,
  },
};
</script>