<template>
  <div class="container">
    <div class="large-12 medium-12 small-12 cell">
      <label>File
        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
      </label>
      <button v-on:click="submitFile()">Submit</button>
    </div>
  </div>
</template>

<script>
export default {
  data () {
    return {
      file: ''
    }
  },
  methods: {
    submitFile () {
      let formData = new FormData()

      formData.append('importLeeds', this.file)

      //     axios.post( '/single-file',
      //         formData,
      //         {
      //         headers: {
      //             'Content-Type': 'multipart/form-data'
      //         }
      //       }
      //     ).then(function(){
      //   console.log('SUCCESS!!');
      // })
      // .catch(function(){
      //   console.log('FAILURE!!');
      // });

      this.$http.post(process.env.API + 'leedsimport', formData).then(function (response) {
        // Success
        this.$toast.success({
          title: 'Arquivo enviado com sucesso',
          message: 'O servidor esta processando, fique a vontade para navegar pelo site enquanto isso'
        })
        console.log(response.data)
        this.$router.push('/list')
      }, function (response) {
        // Error
        // var msg = ''
        // for (var key in response.data) {
        //   msg = msg + ' \n ' + response.data[key]
        // }
        this.$toast.error({
          title: 'Falha ao enviar arquivo',
          message: ''
        })
        console.log(response.data)
      })
    },
    handleFileUpload () {
      this.file = this.$refs.file.files[0]
    }
  }
}
</script>
