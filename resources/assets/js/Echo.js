import swal from 'sweetalert'

Echo.channel('bulldesk-development')
    .listen('.messageUpload', (res) => {
        swal(
            "Sucesso", "A importação do arquivo foi finalizada", "success"
        )
    });




