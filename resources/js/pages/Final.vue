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
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  name: 'Final',

  computed: {
    ...mapState([
      'finished',
    ]),
  },
};
</script>