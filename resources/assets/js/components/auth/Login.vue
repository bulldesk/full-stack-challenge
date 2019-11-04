<template>
    <div class="login row justify-content-center">
        <div class="col-md-4" style="margin-top: 30px">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body" style="padding: 36px">
                    <form @submit.prevent="authenticate">
                        <div class="form-group row">
                            <input type="username" v-model="form.username" class="form-control" placeholder="Usuário">
                        </div>
                        <div class="form-group row">
                            <input type="password" v-model="form.password" class="form-control" placeholder="Senha">
                        </div>
                        <div class="col-md-6" style="margin: 0 auto; width: 50%;">
                            <button type="submit" class="btn btn-outline-info">Entrar</button>
                        </div>

                        <div class="form-group row" v-if="authError">
                            <p class="error">
                                {{ authError }}
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    username: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style scoped>
.error {
    text-align: center;
    color: red;
}
</style>

