<?php
if ($permisos) {
    foreach ($permisos as $value) {
        if ($value->id_permit == 1) {
            $adm = '<div class="material-switch pull-right">
                            <input id="chkadm" name="chkadm" type="checkbox" checked onclick="removePermit(1,' . $perfil->id . ')"/>
                            <label for="chkadm" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 2) {
            $reg = '<div class="material-switch pull-right">
                            <input id="chkreg" name="chkreg" type="checkbox" checked onclick="removePermit(2,' . $perfil->id . ')"/>
                            <label for="chkreg" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 3) {
            $vi = '<div class="material-switch pull-right">
                            <input id="chkvi" name="chkvi" type="checkbox" checked onclick="removePermit(3,' . $perfil->id . ')"/>
                            <label for="chkvi" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 4) {
            $vii = '<div class="material-switch pull-right">
                            <input id="chkvii" name="chkvii" type="checkbox" checked onclick="removePermit(4,' . $perfil->id . ')"/>
                            <label for="chkvii" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 5) {
            $vit = '<div class="material-switch pull-right">
                            <input id="chkvit" name="chkvit" type="checkbox" checked onclick="removePermit(5,' . $perfil->id . ')"/>
                            <label for="chkvit" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 6) {
            $vir = '<div class="material-switch pull-right">
                            <input id="chkvir" name="chkvir" type="checkbox" checked onclick="removePermit(6,' . $perfil->id . ')"/>
                            <label for="chkvir" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 7) {
            $vis = '<div class="material-switch pull-right">
                            <input id="chkvis" name="chkvis" type="checkbox" checked onclick="removePermit(7,' . $perfil->id . ')"/>
                            <label for="chkvis" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 8) {
            $vio = '<div class="material-switch pull-right">
                            <input id="chkvio" name="chkvio" type="checkbox" checked onclick="removePermit(8,' . $perfil->id . ')"/>
                            <label for="chkvio" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 9) {
            $vil = '<div class="material-switch pull-right">
                            <input id="chkvil" name="chkvil" type="checkbox" checked onclick="removePermit(9,' . $perfil->id . ')"/>
                            <label for="chkvil" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 10) {
            $pl3 = '<div class="material-switch pull-right">
                            <input id="chkpl3" name="chkpl3" type="checkbox" checked onclick="removePermit(10,' . $perfil->id . ')"/>
                            <label for="chkpl3" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 11) {
            $actInit = '<div class="material-switch pull-right">
                            <input id="chkactinit" name="chkactinit" type="checkbox" checked onclick="removePermit(11,' . $perfil->id . ')"/>
                            <label for="chkactinit" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 12) {
            $coordPays = '<div class="material-switch pull-right">
                            <input id="chkcoorpays" name="chkacoorpays" type="checkbox" checked onclick="removePermit(12,' . $perfil->id . ')"/>
                            <label for="chkcoorpays" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 13) {
            $materials = '<div class="material-switch pull-right">
                            <input id="chkmaterials" name="chkmaterials" type="checkbox" checked onclick="removePermit(13,' . $perfil->id . ')"/>
                            <label for="chkmaterials" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 14) {
            $financial = '<div class="material-switch pull-right">
                            <input id="chkfinancial" name="chkfinancial" type="checkbox" checked onclick="removePermit(14,' . $perfil->id . ')"/>
                            <label for="chkfinancial" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 15) {
            $cellarmer = '<div class="material-switch pull-right">
                            <input id="chkcellarmer" name="chkcellarmer" type="checkbox" checked onclick="removePermit(15,' . $perfil->id . ')"/>
                            <label for="chkcellarmer" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 16) {
            $cellarext = '<div class="material-switch pull-right">
                            <input id="chkcellarext" name="chkcellarext" type="checkbox" checked onclick="removePermit(16,' . $perfil->id . ')"/>
                            <label for="chkcellarext" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 17) {
            $projects = '<div class="material-switch pull-right">
                            <input id="chkprojects" name="chkprojects" type="checkbox" checked onclick="removePermit(17,' . $perfil->id . ')"/>
                            <label for="chkprojects" class="label-success"></label>
                        </div>';
        }
        if ($value->id_permit == 18) {
            $visitclose = '<div class="material-switch pull-right">
                            <input id="chkvisitclose" name="chkvisitclose" type="checkbox" checked onclick="removePermit(18,' . $perfil->id . ')"/>
                            <label for="chkvisitclose" class="label-success"></label>
                        </div>';
        }
    }
}
?>
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
                        Permisos Usuario <?php echo $perfil->name_user; ?>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?= base_url('Users') ?>"><i class="fa fa-arrow-left" aria-hidden="true"></i>Volver</a></li>
                    </ol>
                </section>
                <section class="content">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead class="thead-light">
                                    <tr>                                         
                                        <?php foreach ($titulos as $td) { ?>                                        
                                            <td><?= $td->name_permit; ?></td>
                                        <?php } ?>   
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr><td>                                      
                                            <?php
                                            if (isset($adm)) {
                                                echo $adm;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkadm" name="chkadm" type="checkbox" onclick="addPermit(1,' . $perfil->id . ')"/>
                            <label for="chkadm" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                            if (isset($reg)) {
                                                echo $reg;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkreg" name="chkreg" type="checkbox" onclick="addPermit(2,' . $perfil->id . ')"/>
                            <label for="chkreg" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                                if (isset($vi)) {
                                                    echo $vi;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkvi" name="chkvi" type="checkbox" onclick="addPermit(3,' . $perfil->id . ')"/>
                            <label for="chkvi" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td><td><?php
                                                if (isset($vii)) {
                                                    echo $vii;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkvii" name="chkvii" type="checkbox" onclick="addPermit(4,' . $perfil->id . ')"/>
                            <label for="chkvii" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td><td><?php
                                                if (isset($vit)) {
                                                    echo $vit;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkvit" name="chkvit" type="checkbox" onclick="addPermit(5,' . $perfil->id . ')"/>
                            <label for="chkvit" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td> 
                                        <td><?php
                                            if (isset($vir)) {
                                                echo $vir;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkvir" name="chkvir" type="checkbox" onclick="addPermit(6,' . $perfil->id . ')"/>
                            <label for="chkvir" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                            if (isset($vis)) {
                                                echo $vis;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkvis" name="chkvis" type="checkbox" onclick="addPermit(7,' . $perfil->id . ')"/>
                            <label for="chkvis" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                                if (isset($vio)) {
                                                    echo $vio;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkvio" name="chkvio" type="checkbox" onclick="addPermit(8,' . $perfil->id . ')"/>
                            <label for="chkvio" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td><td><?php
                                                if (isset($vil)) {
                                                    echo $vil;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkvil" name="chkvil" type="checkbox" onclick="addPermit(9,' . $perfil->id . ')"/>
                            <label for="chkvil" class="label-success"></label>
                        </div>';
                                                }
                                                ?>
                                        </td><td><?php
                                            if (isset($pl3)) {
                                                echo $pl3;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkpl3" name="chkpl3" type="checkbox" onclick="addPermit(10,' . $perfil->id . ')"/>
                            <label for="chkpl3" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                            if (isset($actInit)) {
                                                echo $actInit;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkactinit" name="chkactinit" type="checkbox" onclick="addPermit(11,' . $perfil->id . ')"/>
                            <label for="chkactinit" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td><td><?php
                                                if (isset($coordPays)) {
                                                    echo $coordPays;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkcoorpays" name="chkcoorpays" type="checkbox" onclick="addPermit(12,' . $perfil->id . ')"/>
                            <label for="chkcoorpays" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td><td><?php
                                                if (isset($materials)) {
                                                    echo $materials;
                                                } else {
                                                    echo '<div class="material-switch pull-right">
                            <input id="chkmaterials" name="chkmaterials" type="checkbox" onclick="addPermit(13,' . $perfil->id . ')"/>
                            <label for="chkmaterials" class="label-success"></label>
                        </div>';
                                                }
                                                ?></td>
                                        <td><?php
                                            if (isset($financial)) {
                                                echo $financial;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkfinancial" name="chkfinancial" type="checkbox" onclick="addPermit(14,' . $perfil->id . ')"/>
                            <label for="chkfinancial" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($cellarmer)) {
                                                echo $cellarmer;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkcellarmer" name="chkcellarmer" type="checkbox" onclick="addPermit(15,' . $perfil->id . ')"/>
                            <label for="chkcellarmer" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($cellarext)) {
                                                echo $cellarext;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkcellarext" name="chkcellarext" type="checkbox" onclick="addPermit(16,' . $perfil->id . ')"/>
                            <label for="chkcellarext" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($projects)) {
                                                echo $projects;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkprojects" name="chkprojects" type="checkbox" onclick="addPermit(17,' . $perfil->id . ')"/>
                            <label for="chkprojects" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td>
                                        <td><?php
                                            if (isset($visitclose)) {
                                                echo $visitclose;
                                            } else {
                                                echo '<div class="material-switch pull-right">
                            <input id="chkvisitclose" name="chkvisitclose" type="checkbox" onclick="addPermit(18,' . $perfil->id . ')"/>
                            <label for="chkvisitclose" class="label-success"></label>
                        </div>';
                                            }
                                            ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>                  
                </section>
            </div><?php $this->load->view('templates/libs') ?>
            <?php $this->load->view('templates/js') ?>
            <script type="text/javascript">
                function addPermit(idPermit, idUsuario) {
                    alertify.confirm('Esta seguro de asignar este servicio al usuario', function () {
                        url = get_base_url() + "Users/add_permit";
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {idPermit: idPermit, idUsuario: idUsuario},
                            success: function (resp) {
                                if (resp === "error") {
                                    alertify.error('Erro en BBDD');
                                }
                                if (resp === "ok") {
                                    alertify.success('Permiso asignado');
                                    location.reload();
                                }
                            }
                        })
                    }, function () {
                        alertify.error('Cancelado')
                    });
                }

                function removePermit(idPermit, idUsuario) {
                    alertify.confirm('Esta seguro de remover este servicio al usuario', function () {
                        url = get_base_url() + "Users/remove_permit";
                        $.ajax({
                            url: url,
                            type: "POST",
                            data: {idPermit: idPermit, idUsuario: idUsuario},
                            success: function (resp) {
                                if (resp === "error") {
                                    alertify.error('Erro en BBDD');
                                    location.reload();
                                }
                                if (resp === "ok") {
                                    alertify.success('Permiso removido');
                                    location.reload();
                                }
                            }
                        })
                    }, function () {
                        alertify.error('Acción cancelada');
                        location.reload();
                    });
                }
            </script>
    </body>
</html>