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
                        Administración Usuarios
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>
                <section class="content">
                    <h2><button type="buttom" class="btn btn-success">Añadir Usuario</button></h2>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table id="users-table" class="display" cellspacing="0" width="100%">
                                    <thead>
                                        <tr><th>Nombre</th><th>Perfil</th><th>Permisos</th><th>Acciones</th></tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($usuarios as $celda){ ?>                                            
                                            <tr>
                                                <td><?= $celda->name ?></td>
                                                <td><?= $celda->profile ?></td>
                                                <td><a href="<?= base_url('Users/get_user_permits/') . $celda->id ?>"><i class="fa fa-magic fa-2x"  style="color:green" aria-hidden="true"></i></a></td>
                                                <td><a href="<?= base_url()?>"><i class="fa fa-pencil fa-2x"  style="color:blue" aria-hidden="true"></i></a> <a href="<?= base_url()?>"><i class="fa fa-trash-o fa-2x" style="color:red" aria-hidden="true"></i></a></td>
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
        <script type="text/javascript">
            $(document).ready(function() {
                $('#users-table').DataTable({
                    language: {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
                        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                        "sInfoPostFix":    "",
                        "sSearch":         "Buscar:",
                        "sUrl":            "",
                        "sInfoThousands":  ",",
                        "sLoadingRecords": "Cargando...",
                        "oPaginate": {
                            "sFirst":    "Primero",
                            "sLast":     "Último",
                            "sNext":     "Siguiente",
                            "sPrevious": "Anterior"
                        },
                        "oAria": {
                            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                        }
                    }
                });
            });
        </script>
    </body>
</html>