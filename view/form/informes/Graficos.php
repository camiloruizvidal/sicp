<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include_once Config::$Controller . '/login.php';
include_once Config::$model . '/modeldatos.php';

$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador', 'Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Ficha familiar', 'css' => '../../css/jquery/jquery.dataTables.min.css', 'js' => '../../js/jquery/jquery.dataTables.min.js');
$form->create(__FILE__);
?>
<#--content_ini--#>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script>
    function graficar(data)
    {
        var format_data=($('#tipo_grafico').val()=='pie')?'<b>{point.name}</b>: {point.percentage:.1f}':'{point.y:.1f}';
        Highcharts.setOptions({
            lang: {
                numericSymbols: null//[' thousands', ' millions']
            }
        });
        Highcharts.chart('container', {
            chart: {
                type: $('#tipo_grafico').val()
            },

            title: {
                text: 'Registros SICP'
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category',
                labels: {
                    rotation: 270,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Personas'
                }
            },
            plotOptions: 
            {
                pie: 
                {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: 
                    {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                        style: 
                        {
                            color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                        }
                    }
                },
                bar: {dataLabels: {enabled: true}}
            },
            legend: {
                enabled: true
            },
            credits: {
                enabled: false
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'botom',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            series: [{
                name: 'Cantidad',
                colorByPoint: true,
                data: data.registros,
                allowPointSelect: true,
                dataLabels: {
                    enabled: true,
                    rotation: -90,
                    color: '#FFFFFF',
                    align: 'right',
                    format: format_data,
                    y: 10,
                    style: {
                        fontSize: '13px',
                        fontFamily: 'Verdana, sans-serif'
                    }
                }
            }]
        });
    }
    function buscar()
    {
        $.ajax({
                url: $('#form').attr('action'),
                type: 'POST',
                dataType:'json',
                data: $('#form').serialize(),
                async:false,
                success: function (data)
                {
                    graficar(data);
                    $('#table').html(data);
                },
                error:function(data)
                {
                    console.log(data.responseText);
                    $('#table').html(data);  
                }
            });
    }
    function filtrarCategorias()
    {
        $.ajax({
            url:"../../../controller/anico_ajax.php?control=informes&function=data",
            data:{categoria:$('#categoria').val()},
            type:'POST',
            async:false,
            success:function(data)
            {
                $('#data_campos').html(data);
            }
        });
    }
    function VerCategorias()
    {
        $.ajax({
            url:"../../../controller/anico_ajax.php?control=informes&function=vercategorias",
            type:'POST',
            async:false,
            data:{data:1},
            success:function(data)
            {
                $('#categoria').html(data);
            }
        })
    }
    function departamento()
    {
        $('#departamento').change(function(){
            $.ajax({
                url:"../../../controller/anico_ajax.php?control=datos&function=municipios",
                data:{id:$(this).val()},
                type:'POST',
                success:function(data)
                {
                    $('#municipio').html(data);
                }
            })
        });   
    }
    $(function ()
    {
        departamento();
        VerCategorias();
        filtrarCategorias();
        buscar();
        $('#form').submit(function (e)
        {
            e.preventDefault();
            buscar();
        });
        $('#categoria').change(function()
        {
            filtrarCategorias();
            buscar();
        });
    });
</script>
<div class="col-md-4">
    <div class="panel panel-other">
        <div class="panel-heading">
            Filtro
        </div>
        <form id="form" action="../../../controller/anico_ajax.php?control=informes&function=graficos"  method="POST">
            <div class="panel-body">
                <div class="col-lg-12">
                    <label>Categoria</label>
                    <select id="categoria" name="categoria" class="form form-control">
                        
                    </select>
                </div>
                <div class="col-lg-12">
                    <div class="panel panel-primary" style="color: #fff !important;background-color: #337ab7 !important;border-color: #337ab7 !important;">
                        <a href="#demo" data-toggle="collapse">
                            <div class="panel-heading">
                                Categorias
                            </div>
                        </a>
                        <div id="demo" class="collapse panel-body" style="color: #000 !important;background-color: #FFF !important;border-color: #337ab7 !important;">
                            <div class="container-fluid" id="data_campos">
        
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label>Edad minima</label>
                    <input id="edad_minima" name="edad_minima" class="form form-control"/>
                </div>
                <div class="col-lg-12">
                    <label>Edad maxima</label>
                    <input id="edad_maxima" name="edad_maxima" class="form form-control"/>
                </div>
                <div class="col-lg-12">
                    <label>Sexo</label>
                    <select id="sexo" name="sexo" class="form form-control">
                        <option value="">Seleccione</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
                <div class="col-lg-12">
                    <label>Departamento</label>
                    <select id="departamento" name="departamento" class="form form-control">
                        <option value="">Seleccione</option>
                        <?php
                        $departamento=modeldatos::departamento();
                        foreach($departamento as $temp)
                        {
                            echo '<option value="'.$temp["id_departamentos"].'">'.$temp["descripcion"].'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-12">
                    <label>Municipio</label>
                    <select id="municipio" name="municipio" class="form form-control">
                        <option value="">Seleccione</option>
                    </select>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
</div>
<div class="col-md-8">
    <div class="panel panel-other">
        <div class="panel-heading">
            Informes
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3">
                    <label>Tipo de grafico</label>
                    <select onchange="buscar()" id="tipo_grafico" name="tipo_grafico" class="form form-control">
                        <option value="column">Columnas</option>
                        <option value="line">Lineas</option>
                        <option value="area">Area</option>
                        <option value="pie">pie</option>
                        <option value="areaspline">areaspline</option>
                        <option value="bar">bar</option>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div id="legend"></div>
            </div>
            <div class="col-md-12">
                <div id="container" style="min-width: 100%; max-width: 100%; height: 800px; margin: 0 auto">
                </div>
                <div id="table">
                </div>
            </div>
        </div>
    </div>
</div>
<#--content_fin--#>