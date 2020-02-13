@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
         <link rel="stylesheet" type="text/css" href="{{elixir('css/app.css')}}">
        <script type="text/javascript" src="{{elixir('js/app.js')}}"></script>

    </head>
    <body>
       <div id="example-2">
        <div class="container">
            <div class="panel panel-sm">
              <div class="panel-heading"> 
                <h4>Importação CSV</h4>
              </div>
              <div class="panel-body">
                <div class="form-group">
                  <label for="csv_file" class="control-label col-sm-3 text-right">Arquivo CSV para importar</label>
                  <div class="col-sm-9">
                    <input type="file" id="csv_file" name="csv_file" class="form-control" @change="loadCSV($event)">
                  </div>
                </div>                
                <div class="col-sm-offset-3 col-sm-9">
                  <div id="example-2">
                      <button class="btn btn-primary" v-on:click="csvJSON">Enviar CSV</button>
                   </div>
                </div>
              </div>
            </div>            
          </div>
       </div>       
    </body>
</html>
@endsection