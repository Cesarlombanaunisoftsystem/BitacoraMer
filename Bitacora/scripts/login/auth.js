function login(){
    var user = $( "#email" ).val();
    var pass = $( "#password" ).val();
    url=get_base_url()+"Login/very_sesion";
    $.post(url,{user:user,pass:pass}).done(function(resp){
        if(resp === 1){
            location.href = get_base_url() + "Home";
        }
        if(resp === 0){
            swal({

                title: "Aviso!",

                text: "Usuario y/o contraseña erroneos",

                type: "error",

                confirmButtonText: "Ok"

            });
        }
        if(resp === 2){
            swal({

                title: "Aviso!",

                text: "El usuario no esta activo, por favor verifique su correo si aún no ha validado su email, o comuniquese con Enturne por probable bloqueo.",

                type: "error",

                confirmButtonText: "Ok"

            });
        }
    })

        .fail(function() {
        swal({

            title: "Error!",

            text: "Error en bbdd",

            type: "error",

            confirmButtonText: "Ok"

        });

    });
}


