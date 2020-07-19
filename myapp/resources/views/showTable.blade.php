@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Relacione os colunas</div>
                <form action="{{ route('import') }}" method="POST">
                    @csrf
                    <csv-headers v-bind:dbheaders="dbHeaders" v-bind:fileheaders="fileHeaders"></csv-headers>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary m-2 px-5">Importar dados</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    const app = new Vue({
        el: '#app',
        data: {
            fileName: {!! json_encode($name) !!},
            dbHeaders: {!! json_encode($dbHeaders) !!},
            fileHeaders: {!! json_encode($headers) !!}
            }
    })    
</script>
@endsection