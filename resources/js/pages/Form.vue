<template>
  <div class="container mt-5">

    <div class="row mb-2" v-for="fileField in fileFields" :key="fileField">
      <div class="col">
        {{ fileField }}
      </div>
      <div class="col">
        <select class="form-control" @change="mapField(fileField, $event.target.value)">
          <option value="" />
          <option v-for="databaseField in databaseFields" :key="databaseField">
            {{ databaseField }}
          </option>
        </select>
      </div>
    </div>

    <div class="row">
      <button class="btn btn-primary" @click="submit">
        Enviar
      </button>
    </div>

  </div>
</template>

<script>
import axios from 'axios';
import { mapState } from 'vuex';

export default {
  name: 'Form',

  data() {
    return {
      databaseFields: [
        'id',
        'name',
        'email',
        'document',
        'company',
        'role',
        'phone',
        'city',
        'state',
        'country',
        'status',
        'funnel_stage',
        'business_title',
        'business_value',
        'conversions',
        'last_conversion',
        'domain',
        'register_date',
        'url',
      ],
    };
  },

  computed: {
    ...mapState({
      fileFields: state => state.fields,
      mappedFields: state => state.map,
    }),
  },

  methods: {
    mapField(fileField, databaseField) {
      this.$store.commit('MAP_FIELD', {
        fileField,
        databaseField,
      });
    },

    submit() {
      axios.post('/api/leads/process', {
        fields: this.mappedFields,
      });
    },
  },
};
</script>