<template>
		<div class="form-group">
			<label><strong><i class="fas fa-file-upload"></i> Importar novo CSV:</strong></label>	    
			<CsvImportComponent url="api/imports" :map-fields="field_names" loadBtnText="Ler Arquivo" submitBtnText="Importar" :callback="importSuccess" :catch="importError" :key="csvImportComponentKey" />
		</div>
	</div>
</template>

<script>
	import CsvImportComponent from './CsvImportComponent';

	export default{
		name: "AddImportComponent",
		data() {
			return {
				csvImportComponentKey: 0,
				field_names: [ 
					"name", 
					"email",
					"cpfcnpj",
					"company",
					"occupation",
					"phone",
					"city",
					"state",
					"country",
					"status",
					"stage",
					"business_title",
					"business_value",
					"conversions",
					"last_conversion",
					"domain",
					"register_date",
					"url"
				]
			}
		},
		methods: {
			importSuccess(resp) {
				this.$emit('add-import', resp.data.import);
				this.$swal('Ok!', resp.statusText, 'success');
				this.csvImportComponentKey++;				
			},
			importError(error) {
				this.$swal('Erro ' + error.response.status, error.response.statusText, 'error');
			}
		},
		components: {
			CsvImportComponent
		}
	}
</script>

<style scoped>
	
</style>