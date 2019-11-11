<template>
  <div class="md-layout md-alignment-top-center">
    <md-card id="main" class="md-layout-item md-size-80" md-with-hover>
      <md-card-header>
        <div class="md-title">The Frontend</div>
        <div class="md-subhead">Vue+JWT+vue-material</div>
      </md-card-header>

      <md-card-content>
        <div  v-if="$auth.ready()">
          <img src="./assets/logo.png" />
          <router-view />
        </div>
      </md-card-content>
    </md-card>
  </div>
  </template>

<script>
export default {
  name: 'App'
}
</script>

<style>
#main {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
  min-height: 400px;
}
</style>
