
                swal({
                title: "Esta seguro de asignar este servicio?",
                        text: "Esta acción dara autorizacion de utilizar este módulo!",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: false
                }).then(function() {
                url = get_base_url() + "Users/add_permit/" + idPermit + "/" + idUsuario;
                $.ajax({
                url:url,
                        type:"POST",
                        data:{idPermit, idUsuario},
                        success:function(resp){
                        if (resp === "error"){
                        swal({
                        title: "Error!",
                                type: "warning",
                                text: "Error en la base de datos",
                                timer: 10000,
                                showConfirmButton: false
                        });
                        }
                        if (resp === "ok"){
                        swal({
                        title: "Exito!",
                                type: "success",
                                text: "Permiso agregado exitosamente.",
                                timer: 10000,
                                showConfirmButton: false
                        });
                        location.reload();
                        }
                        }
                });
                }, function(dismiss) {
                if (dismiss === 'cancel') {
                swal("Cancelado", "Acción no realizada!", "error");
                }
                });
                }