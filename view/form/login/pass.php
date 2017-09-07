<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include Config::$Controller . 'login.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador', 'Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar');
$form->create(__FILE__);
?>
<#--content_ini--#>
<?php
$login            = new login();
$Data             = $login->VerUsuario();
$data             = $login->detalle_usuario($Data['id_usuario']);
?>
<script>
    $(function ()
    {
        $('form').submit(function (e)
        {
            loadingstart();
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (data)
                {
                    loadingstop();
                    if (data.valido)
                    {
                        console.log(data);
                        location.href = '../login/pass.php';
                    }
                    else
                    {
                        $.notify({message: data.msj}, {type: 'danger'});
                    }
                }
            });
        });
    });
</script>
<div class="col-md-6">
    <form method="post" action="../../../controller/anico_ajax.php?control=login&function=guardarlogin">
        <div class="panel panel-other">
            <div class="panel-heading">
                Datos
            </div>
            <div class="panel-body">
                <div class="container-fluid">
                    <div class="col-md-12">
                        <label>Nombres</label>
                        <input required="true" class="form form-control" type="text" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>"/>
                    </div>
                    <div class="col-md-12">
                        <label>Apellidos</label>
                        <input required="true" class="form form-control" type="text" id="apellido" name="apellido" value="<?php echo $data['apellido']; ?>"/>
                    </div>
                    <div class="col-md-12">
                        <label>Documento</label>
                        <input required="true" class="form form-control" type="number" id="documento" name="documento" value="<?php echo $data['documento']; ?>"/>
                    </div>
                    <div class="col-md-6">
                        <label>Usuario actual</label>
                        <input required="true" class="form form-control" type="text" id="login" name="login">
                    </div>
                    <div class="col-md-6">
                        <label>Contraseña actual</label>
                        <input required="true" class="form form-control" type="password" id="pass" name="pass">
                    </div>
                    <div class="col-md-6">
                        <label>Contraseña nueva</label>
                        <input required="true" class="form form-control" type="password" id="pass_new_1" name="pass_new_1">
                    </div>
                    <div class="col-md-6">
                        <label>Repita la contraseña nueva</label>
                        <input required="true" class="form form-control" type="password" id="pass_new_2" name="pass_new_2">
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
            Información
        </div>
        <div class="panel-body">
            <div id="datos">
                <label>Nombre</label>:<?php echo $Data['encuestador']; ?><br>
                <label>Documento</label>:<?php echo $Data['documento_responsable']; ?><br>
                <label>Perfil</label>:<?php echo $Data['tipo_perfil']; ?><br>
            </div>
        </div>
    </div>
</div>

<#--content_fin--#>