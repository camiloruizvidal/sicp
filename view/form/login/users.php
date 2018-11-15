<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include Config::$Controller . 'login.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar');
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    function verusers()
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=login&function=veruser', 
            async: false, 
            success: function (data) 
            {
                $('#datos').html(data);
            }
        });
    }
    $(function ()
    {
        verusers();
        $('form').submit(function (e)
        {
            e.preventDefault();
            loadingstart();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (data)
                {
                    verusers();
                    loadingstop();
                }
            });
        });
    });
</script>
<div class="col-md-4">
    <form method="post" action="../../../controller/anico_ajax.php?control=login&function=guardarusuarios">
        <div class="panel panel-other">
            <div class="panel-heading">
                Nuevo usuario
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                <div class="col-md-12">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form form-control" required="required">
                    </div>
                    <div class="col-md-12">
                        <label for="apellido">Apellido</label>
                        <input type="text" id="apellido" name="apellido" class="form form-control" required="required">
                    </div>
                    <div class="col-md-12">
                        <label for="documento">Documento</label>
                        <input type="text" id="documento" name="documento" class="form form-control" required="required">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</div>
<div class="col-md-8">
    <div class="panel panel-other">
        <div class="panel-heading">
            Usuarios
        </div>
        <div class="panel-body">
            <div id="datos">

            </div>
        </div>
    </div>
</div>

<#--content_fin--#>