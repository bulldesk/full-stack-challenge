<template>
	<div class="container panel-container">
    <h4 class="welcome-header">
	    <span class="welcome-text">Bem-vindo(a), {{ user.name }}!</span>
      <a href="#!" title="Sair" @click="logout">
	     	<i class="fas fa-sign-out-alt"></i>
      </a>
    </h4>
    <hr>
    <div v-for="completed_import in completed_imports">
    	<ImportCompletedComponent v-bind:imp="completed_import" v-on:close-message="closeMessage" />
    </div>
    <ImportHistoryComponent v-bind:imports="imports" />
    <hr>
    <AddImportComponent v-on:add-import="addImport" />
	</div>
</template>

<script>
	import axios from 'axios';
	import VueSweetalert2 from 'vue-sweetalert2';
	import VueFilterDateFormat from 'vue-filter-date-format';

	import ImportCompletedComponent from './ImportCompletedComponent';
	import ImportHistoryComponent from './ImportHistoryComponent';
	import AddImportComponent from './AddImportComponent';

	const options = {
	  confirmButtonColor: '#41b882',
	  cancelButtonColor: '#ff7674'
	}
	 
	Vue.use(VueSweetalert2, options);
	Vue.use(VueFilterDateFormat);

	export default {
		name: "PanelComponent",
		data() {
			return {
				user: {},
				imports: [],
				completed_imports: []
			}
		},
		methods: { 
			addImport(imp) {

				// Adiciona a importação no array do histórico
				this.imports = [...this.imports, imp];

				// Cria o listener para o broadcast de importação finalziada
				let self = this;
				window.Echo.private('import.'+imp.id)
			    		.listen('ImportCompleted', (e) => {			    			
			    			// Atualiza a importação como completa
			    			var imports = self.imports.slice();
			    			for (var a=0; a<imports.length; a++) {
			    				if (imports[a].id == imp.id) {
			    					imports[a].completed = true;
			    				}
			    			}
			    			self.imports = imports.slice();

			    			// Exibe a menagem de importação finaliada
		        		self.completed_imports = [...self.completed_imports, imp];

		        		// Desconecta o canal
		        		Echo.leave('import.'+imp.id);
			    		});
			},
			closeMessage(id) {
				this.completed_imports = this.completed_imports.filter(function(obj) {
				  return obj.id !== id;
				});
			},
			logout() {
				axios.post("api/logout").then((resp) => {
					localStorage.removeItem("user");
					window.location.href = "/";
				}).catch((error) => {
					this.$swal('Erro', 'Problema ao realizar logout!', 'error');
				})
			}
		},
		components: {
			ImportCompletedComponent,
			ImportHistoryComponent,
			AddImportComponent
		},
		mounted: function() {

			// Seta os dados de acordo com o localStorage
			var user = localStorage.getItem('user');

			// Caso não existir usuário no localStorage
			if (!user) {
				window.location.href = "/";

			// Se existir
			} else {

				// Transforma a string para um objeto JSON
				user = JSON.parse(user);

				// Caso não existir um token
				if (!user.token) {
					window.location.href = "/";

				// Se existir token, verifica se é válido
				} else {
					this.user = user;
					axios.defaults.headers.common['Authorization'] = 'Bearer ' + user.token;

					let self = this;

					// Faz a requisição
					axios.get("api/user").then((resp) => {

							// Em caso de sucesso, busca as importações do usuário logado
							axios.get("api/imports?created_by="+this.user.id).then((resp) => {
								self.imports = resp.data.imports;
							}).catch((error) => {
								this.$swal('Erro', 'Problema ao carregar importações!', 'error');
							});

						 }).catch((error) => {
						 	window.location.href = "/";
				 		 });
				}
			}
		}
	}
</script>

<style scoped>
	.panel-container {
		width: 60%;
		margin-top: 80px;
		text-align: center;
	}

	.panel-container .welcome-header .welcome-text {
		margin-left: 20px;
	}

	.panel-container .welcome-header a {
		float: right;
		color: #999999;
	}
</style>