<template>
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="mr-auto">
        {{ title }}
      </strong>
    </div>
    <div class="toast-body">
      <slot />
    </div>
  </div>
</template>

<script>
export default {
  name: 'Alert',

  props: {
    title: {
      type: String,
      required: false,
      default: '',
    },
  },

  methods: {
    show() {
      $('.toast').toast('show');
    },
  },

  mounted() {
    $('.toast').toast({
      delay: 5000,
    });
  }
};
</script>