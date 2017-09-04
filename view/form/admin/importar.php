<?php
include_once dirname(__FILE__) . '/../../../base.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Administrador'));

include Config::$Controller . 'anico_form.php';
include_once Config::$Controller . 'ficha.php';
$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'exportar');
$form->create(__FILE__);
?>
<#--content_ini--#>

<script>
    $(function ()
    {
        $('#formuploadajax').submit(function (e)
        {
            var formData = new FormData(document.getElementById("formuploadajax"));
            e.preventDefault();
            $.ajax({
                url: '../ajaxficha/importardata',
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (res) {
                $("#mensaje").html("Respuesta: " + res);
            });
        });
    });
</script>

<form enctype="multipart/form-data" id="formuploadajax" method="post">
    <div class="panel panel-other">
        <div class="panel-heading">
            Cargar ficha 
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <label>Archivo</label>
                <input  type="file" id="archivo1" name="archivo1"/>
            </div>  
            <div class="col-md-6">
                <div id="mensaje"></div>
            </div>
        </div>
        <div class="panel-footer">
            <input class="btn btn-success" type="submit" value="Subir archivos"/>
        </div>
    </div>
</form>
</div>
<#--content_fin--#>