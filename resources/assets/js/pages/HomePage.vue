<template>
    <div>
        <nav-bar title="Marketing"></nav-bar>
        <div class="jumbotron">
            <h1 class="display-4">Bem vindo, {{user}}</h1> 
        </div>    
    </div>
</template>

<script>
    import NavBar from '../components/NavBarComponent'
    export default {
            name:'HomePage',
            data () {        
                return {
                    user: {}
                }
            },
            methods:{},
            components:{
                NavBar,
            },
            mounted() {
                this.user = JSON.parse(localStorage.getItem('user')).name;
            }
        }
</script>
