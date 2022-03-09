$(document).ready(function (e) {
    $("#Login").on('submit', (function (e) {
        e.preventDefault(e);
        $.ajax({
            url: "login_funcionarios.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data);
                if(data.estado){
                    toastr.success('Inicio de sesion ha sido exitoso');
                    
                    window.location = data.codigo;
                }else{
                    toastr.warning(data.php_msg);               
                }
     
    },
    error: function(respuesta) {
        alert(JSON.stringify(respuesta));
    },
});
}));
})