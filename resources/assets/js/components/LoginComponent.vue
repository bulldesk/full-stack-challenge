<template>
	<div class="container login-container">
    <h4>
      Acesse sua conta:
    </h4>
    <form @submit="login">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" v-model="email">
      </div>
      <div class="form-group">
        <label for="password">Senha</label>
        <input type="password" class="form-control" placeholder="Senha" v-model="password">
      </div>
      <div align="center">
				<button type="submit" class="btn btn-primary">Entrar</button>
      </div>
    </form>
	</div>
</template>

<script>
	import axios from 'axios';
	import VueSweetalert2 from 'vue-sweetalert2';

	const options = {
	  confirmButtonColor: '#41b882',
	  cancelButtonColor: '#ff7674'
	}
	 
	Vue.use(VueSweetalert2, options)

	export default {
		name: "LoginComponent",
		data() {
			return {
				email: "",
				password: ""
			}
		},
		methods: {
			login(e) {
				e.preventDefault();
				axios.post("api/login", {
					email: this.email,
					password: this.password

				}).then((resp) => {
					localStorage.setItem('user', JSON.stringify(resp.data));
					window.location.href = "panel";

				}).catch((error) => {
					this.$swal('Erro ' + error.response.status, error.response.statusText, 'error');
				});
			}
		}
	}
</script>

<style scoped>
	.login-container {
		width: 60%;
		margin-top: 80px;
	}

	.login-container h4 {
		text-align: center;
		margin-bottom: 10px;
	}

	.login-container .btn-primary {
		background: rgb(29, 150, 80);
		border-color: rgb(29, 150, 80);
		opacity: 0.8;
		padding: 10px 20px;
		margin-top: 10px;
	}

	.login-container .btn-primary:hover {
		opacity: 1;
	}
</style>