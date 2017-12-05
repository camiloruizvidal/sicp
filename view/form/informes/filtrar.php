<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include_once Config::$Controller . '/login.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador', 'Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar', 'css' => '../../css/jquery/jquery.dataTables.min.css', 'js' => '../../js/jquery/jquery.dataTables.min.js');
$form->create(__FILE__);
?>
<#--content_ini--#>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

    $(function ()
    {
        $('#form_fichas').submit(function (e)
        {
            e.preventDefault();
            $.ajax({
                url: $('#form_fichas').attr('action'),
                type: $('#form_fichas').attr('method'),
                data: $('#form_fichas').serialize(),
                success: function (data)
                {
                    $('#table').html(data);
                    $('#myTable').DataTable();
                }
            });
        });
    });
</script>
<div class="panel panel-other">
    <div class="panel-body">
        <div class="container-alt">
            <form id="form_fichas" action="../../../controller/anico_ajax.php?control=informes&function=registros" method="post">
                <div class="col-md-3">
                    <label>Fecha inicio</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="fecha form-control" name="fecha_ini" id="fecha_ini" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Fecha fin</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input class="fecha form-control" name="fecha_fin" id="fecha_fin" />
                    </div>
                </div>

                <div class="col-md-3">
                    <label>Edad minima</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="number" class="form-control" name="edad_min" id="edad_min" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Edad maxima</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="number" class="form-control" name="edad_max" id="edad_max" />
                    </div>
                </div>
                <div class="col-md-3">
                    <label>Tarjeta familiar</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        <input type="number" class="form-control" name="codigo" id="codigo" />
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="reset" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i> Borrar filtros</button>
                    <button type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i> Filtrar</button>
                    <button type="button" id="exportar" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Exportar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function ()
    {
        $('#exportar').click(function ()
        {
            var url = '../../../controller/anico_ajax.php?control=export&function=xls&' + $('#form_fichas').serialize();
            location.href = url;
        });
    });
</script>
<div class="panel panel-other">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div id="table">
            <?php echo informes::registros(); ?>
        </div>
    </div>
</div>
<#--content_fin--#>