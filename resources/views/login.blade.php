<html>
  <head>
    <title>Teste Bulldesk - Login</title>
    <meta name="csrf-token" contet="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>        
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" type="text/css" href="css/app.css">
  </head>
  <body>
    <div id="login">
      <div class="container">
          <login-component></login-component>
      </div>
    </div>
    <script src="{{ asset('js/login.js') }}"></script>
  </body>
</html>