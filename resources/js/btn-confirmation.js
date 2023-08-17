import Swal from 'sweetalert2'
$(document).ready(function (){
    $(document).on('click', '.btn-confirmation', function (e) {
        e.preventDefault();
        let href = $(this).attr('href');
        Swal.fire({
            title: 'Êtes-vous sur ?',
            text: "Confirmer votre suppression",
            showCancelButton: true,
            confirmButtonText: 'Valider',
            buttonsStyling: false,
            customClass:{
                confirmButton: 'btn btn-danger ml-1',
                cancelButton: 'btn btn-secondary ml-1',
            },
        }).then(function (result) {
            if (result.value) {
                window.location = href;
            }
        })
    });
});
