<template>
	<div class="import-completed-container alert alert-success" role="alert">
	  Sua importação ID {{ imp.id }} foi finalizada em {{ imp.updated_at | formatDate }}
	  <button type="button" class="btn btn-light" @click="closeMessage">Ok</button>
	</div>
</template>

<script>
	export default {
		name: "ImportCompletedComponent",
		props: [ "imp" ],
		methods: {
			closeMessage() {
				this.$emit('close-message', this.imp.id);
			}
		}
	}
</script>

<style scoped>
	.import-completed-container button {
		float: right;
		line-height: 12px;
	}
</style>