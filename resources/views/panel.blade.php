<html>
  <head>
    <title>Teste Bulldesk - Panel</title>
    <meta name="csrf-token" contet="{{ csrf_token() }}">
    <script>window.laravel = { csrfToken: '{{ csrf_token() }}' }</script>        
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/app.css">
  </head>
  <body>
    <div id="panel">
      <div class="container">
        <panel-component></panel-component>
      </div>
    </div>
    <script src="{{ asset('js/panel.js') }}"></script>
  </body>
</html>