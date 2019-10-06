<template>
  <div class="card">
    <div class="card-body">
      
      <h5 class="card-title" v-if="title">
        {{ title }}
      </h5>

      <slot />

    </div>
  </div>
</template>

<script>
export default {
  name: 'Card',

  props: {
    title: {
      type: String,
      required: false,
      default: '',
    }
  }
};
</script>