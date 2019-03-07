<template>
	<div class="import-history-container">
		<h5><i class="far fa-list-alt"></i> Histório de Importações</h5>
		<div v-if="imports.length == 0">
			Você não possui nenhuma importação
		</div>
		<div v-else>
			<table class="table thead-dark table-striped table-dark table-sm" width="100%">
				<thead>
					<th>
						ID
					</th>
					<th>
						Data
					</th>
					<th>
						Finalizada
					</th>
				</thead>
				<tbody>
					<tr v-bind:key="imp.id" v-for="imp in imports">
						<td>
							{{ imp.id }}
						</td>
						<td>
							{{ imp.created_at | formatDate }}
						</td>
						<td>
							{{ imp.completed ? "Sim" : "Não" }}
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default{
		name: "ImportHistoryComponent",
		props: ["imports"],
		data() {
			return {

			}
		}
	}
</script>

<style scoped>

</style>