<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include Config::$Controller . 'login.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar');
$form->create(__FILE__);
?>
<#--content_ini--#>
<script>
    $(function ()
    {
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
                    $.ajax({url: '../ajaxlogin/vercodigosuser', async: false, success: function (data) {
                            $('#datos').html(data);
                        }});
                    loadingstop();
                }
            });
        });
    });
</script>
<div class="col-md-6">
    <form method="post" action="../ajaxlogin/guardarcodigo">
        <div class="panel panel-other">
            <div class="panel-heading">
                Codigos
            </div>
            <div class="panel-body">
                <div class="container-fluid">

                    <div class="col-md-12">
                        <label>Codigo Inicio</label>
                        <input required="true" class="form form-control" type="number" id="codigo_inicio" name="codigo_inicio">
                    </div>
                    <div class="col-md-12">
                        <label>Codigo Fin</label>
                        <input required="true" class="form form-control" type="number" id="codigo_fin" name="codigo_fin">
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
        </div>
    </form>
</div>
<div class="col-md-6">
    <div class="panel panel-other">
        <div class="panel-heading">
            Codigos
        </div>
        <div class="panel-body">
            <div id="datos">
                <?php
                login::vercodigosuser();
                ?>
            </div>
        </div>
    </div>
</div>

<#--content_fin--#>