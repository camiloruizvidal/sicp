<?php
include_once dirname(__FILE__) . '/../../../base.php';
include Config::$Controller . 'anico_form.php';
include Config::$Controller . 'informes.php';
include Config::$Controller . '/login.php';
include Config::$Controller . 'datos.php';
$Validar = new login();
$Validar->UsuarioCorrecto(array('Encuestador', 'Administrador'));

$form->ruta       = '../_plantillas';
$form->plantilla  = '_ficha.php';
$form->parametros = array('titulo' => 'Geo referenciacion', 'css' => '../../css/jquery/jquery.dataTables.min.css', 'js' => array('../../js/jquery/jquery.dataTables.min.js', 'html2canvas.js'));
$form->create(__FILE__);
?>
<#--content_ini--#>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1Jc53ZYuZgWMNoYHTBbXVQQdc8V0F6Eo"></script>
<div class="panel panel-primary">
    <div class="panel-heading">Geo referenciacion</div>
    <div class="panel-body">
        <div class="container-alt">
            <div class="row">
                <div class="col-md-6">
                    <span>Edad inicio</span>
                    <input type="text" class="form form-control"/>
                </div>
                <div class="col-md-6">
                    <span>Edad fin</span>
                    <input type="text" class="form form-control"/>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <span>Genero</span>
                    <select name="genero" id="genero" class="form form-control">
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
                </div>
                <div class="col-md-6" id="genero_hiden">
                    <span><br/>
                        <input type="checkbox" value="si"> Mujer en embarazo
                    </span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Departamento</label>
                    <select name="id_departamento" id="id_departamento" class="form form-control">
                        <?php echo datos::departamento(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Municipio</label>
                    <select name="id_municipio" id="id_municipio" class="form form-control">
                        <?php echo datos::Postmunicipios(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Corregimiento</label>
                    <select name="id_corregimiento" id="id_corregimientos" class="form form-control">
                        <?php echo datos::Postcorregimientos(); ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Veredas</label>
                    <select name="id_vereda" id="id_veredas" class="form form-control">
                        <?php echo datos::Postveredas(); ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button id="save">Buscar</button>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">Geo referenciacion</div>
    <div class="panel-body">
        <div class="container-alt">
            <div class="col-md-6">
                <div id="map" style="width: 500px; height: 400px;"></div>
            </div>
            <div class="col-md-6">
                <div id="data_table">
                </div>
            </div>
        </div>
    </div>
    <div class="panel-footer">
        <button id="save">Guardar mapa</button>
        <button id="generate">Generar mapa</button>
    </div>
</div>
<style>
    .title{

    }
    .data_maps li a{
        color:#000;
    }
</style>
<script type="text/javascript">
    function generate_maps(locations, ini_long, ini_lati, zoom)
    {
        var map = new google.maps.Map(document.getElementById('map'),
                {
                    zoom: zoom,
                    center: new google.maps.LatLng(ini_long, ini_lati),
                    mapTypeId: google.maps.MapTypeId.HYBRID
                });
        var infowindow = new google.maps.InfoWindow();
        var marker, i;
        for (i = 0; i < locations.length; i++)
        {
            marker = new google.maps.Marker(
                    {
                        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                        map: map
                    });
            google.maps.event.addListener(marker, 'click', (function (marker, i)
            {
                return function ()
                {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }
    $(function ()
    {
        $('#id_municipio').change(function ()
        {
            veredas($(this).val());
            corregimiento($(this).val());
        });
        $('#id_departamento').change(function ()
        {
            municipios($(this).val());
        });
        $('#generate').click(function ()
        {
            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                data: {data: null},
                dataType: 'json',
                success: function (data)
                {
                    try
                    {
                        if (data.success)
                        {
                            generate_maps(data.data, data.longitud, data.latitud, data.zoom);
                            info_people(data.data);
                        }
                    }
                    catch (Exception)
                    {
                        alert("No se ha podido establecer conexion con el generador de mapas. Msg: " + Exception);
                    }
                }
            });
        });
        $('#generate').click();
        $('#save').click(function ()
        {
            save('#map', 'map.png');
        });
    });
    function info_people(data)
    {
        var html = '<table class="table table-hover">';
        html += '<tr>';
        html += '<th><i class="fa fa-users" aria-hidden="true"></i> Persona</th>';
        html += '<th><i class="fa fa-map-marker" aria-hidden="true"></i> Longitud</th>';
        html += '<th><i class="fa fa-map-marker" aria-hidden="true"></i> Latitud</th>';
        html += '</tr>';
        $.each(data, function (index, value)
        {
            html += '<tr>';
            $.each(value, function (index1, value1)
            {
                html += '<td>';
                html += value1;
                html += '</td>';
            });
            html += '</tr>';
        });
        html += '</table>';
        $('#data_table').html(html);
    }
    function save(canvasId, filename)
    {
        html2canvas($(canvasId),
                {
                    useCORS: true,
                    onrendered: function (canvas)
                    {
                        theCanvas = canvas;
                        document.body.appendChild(canvas);

                        // Convert and download as image 
                        Canvas2Image.saveAsPNG(canvas);
                        console.log(canvas);
                        $("#img-out").append(canvas);
                    }
                });
    }
    function corregimiento(id_municipio)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=corregimientos',
            type: 'POST',
            data: {id: id_municipio},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_corregimientos').html(data);
            }
        });
    }
    function veredas(id_municipio)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=veredas',
            type: 'POST',
            data: {id: id_municipio},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_veredas').html(data);
            }
        });
    }
    function municipios(id_departamento)
    {
        $.ajax({
            url: '../../../controller/anico_ajax.php?control=datos&function=municipios',
            type: 'POST',
            data: {id: id_departamento},
            async: false,
            success: function (data, textStatus, jqXHR)
            {
                $('#id_municipio').html(data);
            }
        });
    }
</script>


<#--content_fin--#>