<template>
   <form @submit.prevent="login" class="form-signin">
      <div v-if="mensagem.length > 0" class="alert alert-danger" role="alert">
        {{mensagem}}
      </div>
      <h1 class="h3 mb-3 font-weight-normal">Login</h1>
      <label for="inputEmail" class="sr-only">Email</label>
      <input type="email" id="inputEmail" class="form-control" placeholder="Email address" v-model="formData.email" required autofocus>
      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" id="inputPassword" class="form-control" v-model="formData.password" placeholder="Password" required>
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me" v-model="formData.remember"> Remember me
        </label>
      </div>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
</form>
</template>

<script>
    import * as s from '../servicos'
    export default {
        data(){
            return {
            formData: {
                email: '',
                password: '',
                remember:false
            },
            mensagem: '',
            }
        },
        methods:{
            login(){
                s.fazLogin(this.formData.email, this.formData.password).then(resp => {
                    if(resp.status){
                        const credenciais = btoa(this.formData.email+':'+this.formData.password)
                        localStorage.setItem("credenciais", JSON.stringify({credenciais}));
                        localStorage.setItem("user", resp.data);
                        this.$router.push('admin');
                    }else{
                        this.mensagem = resp.messages;     
                    }
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>
.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>