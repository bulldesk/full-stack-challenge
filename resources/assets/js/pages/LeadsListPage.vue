<template>
    <div>
        <nav-bar title="Marketing"></nav-bar>
        <div class="jumbotron">
            <table class="table table-striped importacao-table">
              <thead> 
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Empresa</th>
                  <th scope="col">Telefone</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="user of users">
                  <th scope="row"></th>
                    <td>{{user.email}}</td>
                    <td>{{user.email}}</td>
                    <td>{{user.empresa}}</td>
                    <td>{{user.telefone}}</td>
                </tr>
              </tbody>
            </table>    
            <vue-pagination :pagination="items"
                    @paginate="leads()"
                    :offset="4">
            </vue-pagination>
        </div>    
    </div>
</template>

<script>
    import NavBar from '../components/NavBarComponent'
    import * as s from '../servicos'
    import VuePagination from '../components/PaginationComponent'

    export default {
            name:'LeadsListPage',
            data () {        
                return {
                    users: {
                        total: 0,
                        per_page: 2,
                        from: 1,
                        to: 0,
                        current_page: 1
                    },
                    offset: 4,
                    items:{}
                }
            },
            methods:{
                leads(){    
                    s.getLeads(this.items.current_page).then(resp => {
                        this.items = resp;
                        this.users = resp.data;
                    })
                }
            },
            components:{
                NavBar,
                VuePagination
            },
            mounted() {
                this.leads(); 
            }
        }
</script>
