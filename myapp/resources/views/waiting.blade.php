@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Status</div>
                <div class="card-body text-center">
                    <h3>@{{ message }}</h3>
                    <a v-if="status" href="/home" class="btn btn-primary my-2 px-4">Voltar</a>
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
            message: 'Importando dados, aguarde...',
            status: false
        },
        mounted() {
            console.log('wait');
            Echo.channel('mychannel')
            .listen('.alldone', () => {
                console.log('done');
                this.message = 'Dados importados com sucesso!';
                this.status = true;
            });
        }
    })    
</script>
@endsection