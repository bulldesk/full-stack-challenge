<template>
  <div class="Sobre">
    <h1>Sobre</h1>
    <p>Frontend construido em Vue com jwt e vue-material para integração com backend</p>
    <router-link tag="md-button" class="md-button md-raised md-success" to="/list">
      <md-icon>arrow_back</md-icon> Entrar
    </router-link>
  </div>
</template>
<script>
export default {
  name: 'Sobre',
  data () {
    return {
    }
  }
}
</script>
