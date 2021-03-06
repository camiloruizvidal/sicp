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
        //$('#myTable').DataTable();
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
            <div class="container-fluid">
                <div class="col-md-12">
                    <div id="load_tada_res"></div>
                    <div id="load_tada"></div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function ()
    {
        function load_data()
        {
            var d = new Date();
            var month = d.getMonth()+1;
            var day = d.getDate();
            var dt = new Date();
            var time = dt.getHours() +''+ dt.getMinutes() +''+ dt.getSeconds();
            var output = d.getFullYear()+(month<10 ? '0' : '') + month + (day<10 ? '0' : '') + day+time;
            var url = '../../../controller/estado.json?V='+ output;
            $.ajax({
                url:url,
                dataType:'json',
                success:function(data)
                {
                    var html='<ul><li>Proceso de la generacion del archivo excel</li>';
                    $.each(data,function(index,value)
                    {
                        html+='<li>';
                        html+=value;
                        html+='</li>';
                    });
                    html+='</ul>';
                    $('#load_tada').html(html);
                }
            })
        }
        $('#exportar').click(function ()
        {
            $('#load_tada').html('<span class="label label-danger">Comenzo el proceso de exportacion</span>');
            $('#load_tada_res').hide();
            $('#load_tada').show();
            $('#exportar').attr("disabled", true);
            setInterval(function()
            {
                load_data();
            },5000);
            var url = '../../../controller/anico_ajax.php?control=export&function=xls&' + $('#form_fichas').serialize();
            $.ajax({
                url:url,
                dataType:'json',
                success:function(data)
                {
                    if(data.validate)
                    {
                        $('#load_tada_res').show();
                        $('#load_tada').hide();
                        $('#load_tada_res').html('<a class="btn btn-success" href="'+data.url+'">Click aqui si no le descarga el documento</a>')
                        window.open(data.url, "Diseño Web", "width=300, height=200");
                        $('#exportar').removeAttr("disabled");
                    }
                    else
                    {
                        alert(data.msj);
                    }
                },
                error:function(data)
                {
                    console.log(data);
                    $('#load_tada_res').show();
                    $('#load_tada').hide();
                    $('#load_tada_res').html('<a class="btn btn-danger" href="../../../controller/informe.csv">Se presento un error, pero genero este documento</a>')
                    $('#exportar').removeAttr("disabled");
                }
            })
        });
    });
</script>
<div class="panel panel-other">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div id="table">
            <?php //echo informes::registros(); ?>
        </div>
    </div>
</div>
<#--content_fin--#>