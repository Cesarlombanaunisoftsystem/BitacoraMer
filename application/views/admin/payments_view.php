<!DOCTYPE html>
<html>
    <head>
        <?php $this->load->view('templates/head') ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <div class="wrapper">
            <?php $this->load->view('templates/header') ?>
            <!-- Left side column. contains the logo and sidebar -->
            <?php $this->load->view('templates/menu-right') ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Administración Formas de Pago
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Parametrization'); ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success" data-toggle="modal" data-target="#add-pay">Añadir Forma de Pago</button></h2>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table id="data-table" class="display" cellspacing="0" width="100%">
                                <thead>
                                    <tr><th>Nombre</th><th>Fecha de creación</th><th>Acciones</th></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($payments as $pay) { ?>                                            
                                        <tr>
                                            <td><?= $pay->name_pay ?></td>
                                            <td><?= $pay->dateSave ?></td>
                                            <td><a href="<?= base_url('Parametrization/get_pay/') . $pay->id ?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="javascript:deletePay(<?= $pay->id ?>)"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
                                        </tr>                                                                                    
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>                  
                </section>
            </div>
            <!-- /.content-wrapper -->
            <?php $this->load->view('templates/footer.html') ?>
        </div>
        <!-- ./wrapper -->
        <?php $this->load->view('templates/libs') ?>
        <?php $this->load->view('templates/js') ?>
        <!-- Modal -->
        <div id="add-pay" class="modal fade" role="dialog">
            <div class="modal-dialog" style="width: 30%;">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h3 class="modal-title" id="exampleModalLongTitle">Añadir forma de pago</h3>
                    </div>
                    <form id="frmAddPay" action="javascript:addPay()" method="post">
                        <div class="modal-body">                        
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" name="name" placeholder="Nombre Completo">                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function addPay() {
                url = get_base_url() + "Parametrization/add_pay";
                $.ajax({
                    url: url,
                    type: $("#frmAddPay").attr("method"),
                    data: $("#frmAddPay").serialize(),
                    success: function (resp) {
                        if (resp === "error") {
                            alertify.error('Erro en BBDD');
                        }
                        if (resp === "ok") {
                            alertify.success('Metodo de pago agregado exitosamente');
                            location.reload();
                        }
                    }
                });
            }
            function deletePay(id) {
                alertify.confirm('Esta seguro de eliminar este metodo de pago?, esta acción no podra ser removida.', function () {
                    url = get_base_url() + "Parametrization/delete_pay";
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {idPay: id},
                        success: function (resp) {
                            if (resp === "error") {
                                alertify.error('Error en bbdd');
                            }
                            if (resp === "ok") {
                                alertify.success('Metodo de pago eliminado');
                                location.reload();
                            }
                        }
                    });
                }, function () {
                    alertify.error('Acción cancelada');
                });
            }
        </script>
    </body>
</html>