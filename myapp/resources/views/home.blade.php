@extends('layouts.app')

@section('content')
<div class="container" id="home">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Selecione um arquivo CSV</div>
                <div class="card-body">
                    <form v-bind:action="postRoute" method="POST" enctype="multipart/form-data">
                        @csrf
                        <upload-form></upload-form>
                        <div class="text-center">
                            <button class="btn btn-primary px-5 mt-3" type="submit">Upload</button>
                        </div>
                        <div v-if="error" class="alert-danger p-2 mt-3 rounded">@{{ error }}</div>
                    </form>
                </div>
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
            postRoute: {!! json_encode(route('upload')) !!},
            error: {!! json_encode($errors->first('csvFile')) !!}
        }
    })    
</script>
@endsection