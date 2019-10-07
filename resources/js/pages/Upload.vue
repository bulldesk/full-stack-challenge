<template>
  <div class="container mt-5">
    <div class="row">
      <div class="col">
        <input class="mb-2" type="file" @input="selectFile">
      </div>
    </div>
    <div class="row">
      <div class="col">
        <button class="btn btn-primary" @click="submit">Enviar</button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Upload',

  data() {
    return {
      file: null,
    };
  },

  methods: {
    selectFile(event) {
      this.file = event.target.files[0];
    },
    submit() {
      const formData = new FormData();
      formData.append('file', this.file);

      axios.post('/api/files/upload', formData, {
        headers: {
          'Content-Type': 'multipart/form-data',
        }
      })
        .then((res) => {
          const { fields } = res.data;

          this.$store.commit('SET_FIELDS', fields);
          this.$router.push('/form');
        })
        .catch((err) => {
          console.log(err);
        });
    }
  },
};
</script>